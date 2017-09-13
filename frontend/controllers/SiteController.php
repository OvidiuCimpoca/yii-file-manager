<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\CreateTaskForm;
use app\models\CreateProjectForm;
use app\models\Task;
use app\models\Project;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    // This is where my code starts
    /*
     * The why I thought it is that a project can have more tasks and
     * we can have more projects.
     * */
    // This is where I get project information for the project list
    public function actionProjects()
    {
        // Replace the if with a check to see if the user has permission
        $query = Project::find();

        $query = new \yii\db\Query;
        $query->select('*, user.username')->from('project')->leftJoin('user', 'user.id = project.createdby');
        $command = $query->createCommand();
        $projects = $command->queryAll();

        return $this->render('projects',
            [
                'projects' => $projects
            ]);
    }

    // This is where I get task information for the task list
    public function actionProject()
    {
        $request = Yii::$app->request;
        $get = $request->get();
        // Also check if tasks belong the the user, if he can see them
        if(isset($get['id'])){

            $query = new \yii\db\Query;
            $query->select('task.*,
                task_status.name as tsname,
                priority.name as pname,
                user.username as dvname,
                user2.username as crname')
                ->from('task')
                ->leftJoin('task_status', 'task.status = task_status.id')
                ->leftJoin('priority', 'task.priority = priority.id')
                ->leftJoin('user', 'task.developerid = user.id')
                ->leftJoin('user as user2', 'task.createdby = user2.id')
                ->where('projectid = '  . $get['id']);
            $command = $query->createCommand();
            $resp = $command->queryAll();

            return $this->render('project',
                [
                    'hasPermission' => 1,
                    'projectId' => $get['id'],
                    'tasks' => $resp,
                ]);
        }
        return $this->render('project',
            [
                'hasPermission' => 0
            ]);
    }

    // This is where I get task information for the task page
    public function actionTask()
    {
        $request = Yii::$app->request;
        $get = $request->get();
        $ret = ['setTable' => 0];
        if(isset($get['id'])){


            $query = new \yii\db\Query;
            $query->select('task.*, project.name as projectname')
                ->from('task')
                ->leftJoin('project', 'task.projectid=project.id')
                ->where('task.id = ' . $get['id']);
            $command = $query->createCommand();
            $resp = $command->queryAll();
            $task =  $resp[0];

            $query2 = new \yii\db\Query;
            $query2->select('*')
                ->from('task_status');
            $command = $query2->createCommand();
            $statusList = $command->queryAll();

            $backToPoject = Url::base(true) . "?r=site/project&id=" . $task["projectid"];
            $ret = [
                'setTable' => 1,
                'backToPoject' => $backToPoject,
                'id' => $task["id"],
                'name' => $task["name"],
                'project' => $task["projectid"],
                'projectName' => $task["projectname"],
                'description' => $task["description"],
                'createdby' => $task["createdby"],
                'developerid' => $task["developerid"],
                'statusList' => $statusList,
                'status' => $task["status"],
                'priority' => $task["priority"],
                'estimated' => $task["estimated"],
                'elapsed' => $task["elapsed"],
                'createdat' => $task["createdat"],
                'updatedat' => $task["updatedat"],
                'closedat' => $task["closedat"],
                'due' => $task["due"]
            ];
        }

        return $this->render('task', $ret);
    }

    public function actionCreateTask()
    {
        $model = new CreateTaskForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            $formPost = Yii::$app->request->post()['CreateTaskForm'];
            $task = new Task();
            $task->name = $formPost['name'];
            $task->projectid = $formPost['projectid'];
            $task->description = $formPost['description'];
            $task->createdby = $formPost['createdby'];
            $task->developerid = $formPost['developerid'];
            $task->priority = $formPost['priority'];
            $time = Yii::$app->formatter->asTime($formPost['estimated'] * 60, 'php:H:i:s');
            //var_dump($time);
            //die();
            $task->estimated = $time;
            $task->createdat = $formPost['createdat'];
            $task->due = $formPost['due'];
            $task->save();
            /*
             * Notes to do
             * Change link to go to newly created task
             * */
            return $this->render('create-task-confirm', [
                'name' => $formPost['name']
            ]);
        }

        $query = new \yii\db\Query;
        $query->select('id, name, abbreviation')->from('project');
        $command = $query->createCommand();
        $projectList = $command->queryAll();
        $projectValues = [];
        foreach($projectList as $project){
            $projectValues[$project['id']] = $project['name'];
        }
        $query->select('id, username')->from('user');
        $command = $query->createCommand();
        $userList = $command->queryAll();
        $usersValue = [];
        foreach($userList as $user){
            $usersValue[$user['id']] = $user['username'];
        }
        $query->select('*')->from('priority');
        $command = $query->createCommand();
        $priorityList = $command->queryAll();
        $priorities = [];
        foreach ($priorityList as $priority){
            $priorities[$priority['id']] = $priority['name'];
        }
        $request = Yii::$app->request;
        $get = $request->get();
        if(isset($get['id'])){
            return $this->render('create-task', [
                'model' => $model,
                'projects' => $projectValues,
                'users' => $usersValue,
                'priorities' => $priorities,
                'projectId' => $get['id'],
            ]);
        }
        return $this->render('create-task', [
            'model' => $model,
            'projects' => $projectValues,
            'users' => $usersValue,
            'priorities' => $priorities,
        ]);
    }

    public function actionCreateProject(){

        $model = new CreateProjectForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            $formPost = Yii::$app->request->post()['CreateProjectForm'];
            $project = new Project();
            $project->name = $formPost['name'];
            $project->description = $formPost['description'];
            $project->abbreviation = $formPost['abbreviation'];
            $project->createdby = $formPost['createdby'];
            $project->createdat = $formPost['createdat'];
            $project->save();

            return $this->render('create-project-confirm', [
                'name' => $formPost['name'],
            ]);

        }

        $query = new \yii\db\Query;
        $query->select('id, username')->from('user');
        $command = $query->createCommand();
        $userList = $command->queryAll();
        $usersValue = [];
        foreach($userList as $user){
            $usersValue[$user['id']] = $user['username'];
        }

        return $this->render('create-project', [
            'model' => $model,
            'users' => $usersValue,
        ]);
    }
}
