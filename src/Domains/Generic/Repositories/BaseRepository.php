<?php

namespace AKCE\Generic\Repositories;

use AKCE\Generic\Contracts\IBaseRepository as IBaseRepository;

abstract class BaseRepository implements IBaseRepository
{
    protected $_model;

    function __construct()
    {
    }

    public function Get()
    {
        $model = $this->_model;
        return $model::all();
    }

    public function GetWithRelationships()
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();
        
        foreach ($relationships as $relationship => $info)
        {
            array_push($returnRelationships, $relationship);
        }

        return $model::with($returnRelationships)->all();
    }

    public function GetWithPagination($page, $itemsperpage)
    {
        $model = $this->_model;
        return $model::orderBy("id", "desc")->skip(($page - 1) * $itemsperpage)->take($itemsperpage)->get();
    }

    public function GetWithRelationshipsAndPagination($page, $itemsperpage)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();
        
        foreach ($relationships as $relationship => $info)
        {
            array_push($returnRelationships, $relationship);
        }

        return $model::with($returnRelationships)->orderBy("id", "desc")->skip(($page - 1) * $itemsperpage)->take($itemsperpage)->get();
    }

    public function GetCount()
    {
        $model = $this->_model;
        return $model::count();
    }

    public function Find($id)
    {
        $model = $this->_model;
        return $model::find($id);
    }

    public function FindWithRelationships($id)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();
        
        foreach ($relationships as $relationship => $info)
        {
            array_push($returnRelationships, $relationship);
        }

        return $model::with($returnRelationships)->find($id);
    }

    public function Insert($data)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();
        
        $create = $model::create($data);
        
        foreach ($relationships as $relationship => $info)
        {
            if(array_key_exists($relationship, $data))
            {
                array_push($returnRelationships, $relationship);
                $create->$relationship()->createMany($data[$relationship]);
            }
        }

        return $model::with($returnRelationships)->find($create->id);
    }

    public function Update($id, $data)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();
        $returnRelationships = array();

        $searchItem = $model::find($id);

        $searchItem->update($data);

        foreach ($relationships as $relationship => $info)
        {
            if(array_key_exists($relationship, $data))
            {
                array_push($returnRelationships, $relationship);

                $relModel = $info["model"];
                foreach($data[$relationship] as $relItem)
                {
                    if(isset($relItem["id"]))
                    {
                        $relModel::find($relItem["id"])->update($relItem);
                    }
                    else
                    {
                        $searchItem->$relationship()->create($relItem);
                    }
                }
            }
        }

        return $model::with($returnRelationships)->find($id);
    }
    
    public function Delete($id)
    {
        $model = $this->_model;
        $relationships = (new $model)->relationships();

        foreach ($relationships as $relationship => $info)
        {
            $relModel = $info["model"];
            $relModel::where($info["foreignKey"], $id)->delete();
        }

        return $model::destroy($id);
    }

    public function getValidationRules()
    {
        $model = $this->_model;
        return $model::$rules;
    }

    public function FindAndLock($id)
    {
        $model = $this->_model;

        $retrieveAndLock = $model::lockForUpdate()->find($id);

        return $retrieveAndLock;
    }

    public function UpdateAndUnlock($lock)
    {
        $lock->save();

        return true;
    }
}