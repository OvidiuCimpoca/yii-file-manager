<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\db\Query;
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
        $goTo = Url::base(true) . "?r=site/project&id=";
        $request = Yii::$app->request;
        $get = $request->get();
        // Replace the if with a check to see if the user has permission
        if(isset($get['id'])){

            $query = Project::find();

            $projects = $query->orderBy('name')->all();

            return $this->render('projects',
                [
                    'hasPermission' => 1,
                    'goTo' => $goTo,
                    'projects' => $projects
                ]);
        }

        return $this->render('projects',
            [
                'hasPermission' => 0,
            ]);
    }

    // This is where I get task information for the task list
    public function actionProject()
    {
        $goTo = Url::base(true) . "?r=site/task&id=";
        $request = Yii::$app->request;
        $get = $request->get();
        // Also check if tasks belong the the user, if he can see them
        if(isset($get['id'])){

            $query = Task::find();

            $tasks = $query->where('projectid = ' . $get['id'])->orderBy('name')->all();

            return $this->render('project',
                [
                    'hasPermission' => 1,
                    'goTo' => $goTo,
                    'tasks' => $tasks
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

            return $this->render('task',
                [
                    'setTable' => 1,
                    'backToPoject' => $backToPoject,
                    'id' => $task["id"],
                    'name' => $task["name"],
                    'project' => $task["projectid"],
                    'projectName' => $task["projectname"],
                    'tasknr' => $task["tasknr"],
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
                ]);
        }

        return $this->render('task',
            [
                'setTable' => 0,
                'id' => '',
                'name' => '',
                'project' => '',
                'tasknr' => '',
                'description' => '',
                'developer' => '',
                'status' => '',
                'priority' => '',
                'estimated' => '',
                'elapsed' => '',
                'createdat' => '',
                'updatedat' => '',
                'closedat' => '',
                'due' => ''
            ]);
    }

    public function actionCreateTask()
    {
        $model = new CreateTaskForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            return $this->render('create-task-confirm', ['model' => $model]);
        }

        $query = new \yii\db\Query;
        $query->select('id, name, abbreviation')->from('project');
        $command = $query->createCommand();
        $projectList = $command->queryAll();
        return $this->render('create-task', [
            'model' => $model,
            'projects' => $projectList,
            ]);
    }
}
