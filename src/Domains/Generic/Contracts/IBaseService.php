<?php

namespace AKCE\Generic\Contracts;

interface IBaseService
{
    public function Get($page, $itemsperpage);
    public function GetWithRelationships($page, $itemsperpage);
    public function Find($id);
    public function FindWithRelationships($id);
    public function Insert($data);
    public function Update($id, $data);
    public function Delete($id);
}