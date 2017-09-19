<?php

namespace app\models;

use Yii;

class Project extends yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{project}}';
    }

    public static function getProjects()
    {
        $query = new yii\db\Query;
        $query->select('project.*, user.username')->from('project')->leftJoin('user', 'project.createdby = user.id');
        return $query;
    }

    public static function saveProject($formPost)
    {
        $project = new Project();
        $project->name = $formPost['name'];
        $project->description = $formPost['description'];
        $project->abbreviation = $formPost['abbreviation'];
        $project->createdby = $formPost['createdby'];
        $project->createdat = $formPost['createdat'];
        return $project->save();
    }

    public static function updateProject($getId ,$formPost)
    {
        $project = Project::findOne($getId);
        $project->name = $formPost['name'];
        $project->description = $formPost['description'];
        $project->abbreviation = $formPost['abbreviation'];
        return $project->update();
    }

    public static function getProject($getId)
    {
        return Project::findOne($getId);
    }
}