<?php

namespace app\models;

use Yii;

class Task extends yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{task}}';
    }

    public static function getTasks($projectId)
    {
        $query = new yii\db\Query;
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
            ->where('projectid = '  . $projectId)
            ->orderBy('task.id');
        return $query;
    }

    public static function getTasksDeveloper($projectId, $userId)
    {
        $query = new yii\db\Query;
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
            ->where('projectid = '  . $projectId)
            ->andWhere('user.id = ' . $userId)
            ->orderBy('task.id');
        return $query;
    }

    public static function getTaskView($taskId)
    {
        $query = new yii\db\Query;
        $query->select('task.*,
                project.name as projectname,
                task_status.name as task_status_name,
                priority.name as pr_name,
                user.username as created_task,
                user2.username as assigned_to')
            ->from('task')
            ->leftJoin('project', 'task.projectid=project.id')
            ->leftJoin('task_status', 'task.status = task_status.id')
            ->leftJoin('priority','task.priority = priority.id')
            ->leftJoin('user', 'task.createdby = user.id')
            ->leftJoin('user as user2', 'task.developerid = user2.id')
            ->where('task.id = ' . $taskId);
        return $query;
    }

    public static function saveTask($formPost)
    {
        $task = new Task();
        $task->name = $formPost['name'];
        $task->projectid = $formPost['projectid'];
        $task->description = $formPost['description'];
        $task->createdby = $formPost['createdby'];
        $task->developerid = $formPost['developerid'];
        $task->priority = $formPost['priority'];
        $time = Yii::$app->formatter->asTime($formPost['estimated'], 'php:H:i:s');
        $task->estimated = $time;
        $task->createdat = $formPost['createdat'];
        $task->due = $formPost['due'];
        return $task->save();
    }
}
