<?php

namespace AKCE\Generic\Contracts;

interface IBaseRepository
{
    public function Get();
    public function GetWithRelationships();
    public function GetWithPagination($page, $itemsperpage);
    public function GetWithRelationshipsAndPagination($page, $itemsperpage);
    public function GetCount();
    public function Find($id);
    public function FindWithRelationships($id);
    public function Insert($data);
    public function Update($id, $data);
    public function Delete($id);
    public function getValidationRules();
    public function FindAndLock($id);
    public function UpdateAndUnlock($lock);
}