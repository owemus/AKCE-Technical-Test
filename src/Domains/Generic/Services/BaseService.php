<?php

namespace AKCE\Generic\Services;

use AKCE\Generic\Contracts\IBaseService as IBaseService;

use Infrastructure\Utils\ResponseUtil as ResponseUtil;
use Infrastructure\Utils\ValidationUtil as ValidationUtil;
use App\Exceptions\ValidationMessages as ValidationMessages;

abstract class BaseService implements IBaseService
{
    protected $_repository;
    protected $_responseUtil;
    protected $_validationUtil;
    
    function __construct()
    {
        $this->_responseUtil = new ResponseUtil();
        $this->_validationUtil = new ValidationUtil();
    }

    public function Get($page = 10, $itemsperpage = 999999)
    {
        $data = $this->_repository->GetWithPagination($page, $itemsperpage);
        
        $pagination = array(
            "total" => $this->_repository->GetCount(),
            "items_per_page" => $itemsperpage,
            "current_page" => $page,
            "last_page" => ceil($this->_repository->GetCount() / $itemsperpage),
        );
        return $this->_responseUtil->GenerateResponse(true, $data, $pagination, null);
    }

    public function GetWithRelationships($page = 10, $itemsperpage = 999999)
    {
        $data = $this->_repository->GetWithRelationshipsAndPagination($page, $itemsperpage);
        
        $pagination = array(
            "total" => $this->_repository->GetCount(),
            "items_per_page" => $itemsperpage,
            "current_page" => $page,
            "last_page" => ceil($this->_repository->GetCount() / $itemsperpage),
        );
        return $this->_responseUtil->GenerateResponse(true, $data, $pagination, null);
    }

    public function Find($id)
    {
        $data = $this->_repository->Find($id);
        
        if($data !== null)
        {
            return $this->_responseUtil->GenerateResponse(true, $data, null, null);
        }
        else
        {
            return $this->_responseUtil->GenerateResponse(false, null, null, ValidationMessages::CouldNotFindInitialObject);
        }
    }

    public function FindWithRelationships($id)
    {
        $data = $this->_repository->FindWithRelationships($id);
        
        if($data !== null)
        {
            return $this->_responseUtil->GenerateResponse(true, $data, null, null);
        }
        else
        {
            return $this->_responseUtil->GenerateResponse(false, null, null, ValidationMessages::CouldNotFindInitialObject);
        }
    }

    public function Insert($data)
    {
        $validator = $this->_validationUtil->Validate($data, $this->_repository->getValidationRules());

        if($validator["success"])
        {
            $insert = $this->_repository->Insert($data);
            return $this->_responseUtil->GenerateResponse(true, $insert, null, null);
        }
        else
        {
            return $this->_responseUtil->GenerateResponse(false, null, null, ValidationMessages::InvalidInput);
        }
    }

    public function Update($id, $data)
    {
        $validator = $this->_validationUtil->Validate($data, $this->_repository->getValidationRules());

        if($validator["success"])
        {
            $update = $this->_repository->Update($id, $data);
            return $this->_responseUtil->GenerateResponse(true, $update, null, null);
        }
        else
        {
            return $this->_responseUtil->GenerateResponse(false, null, null, ValidationMessages::InvalidInput);
        }
    }

    public function Delete($id)
    {
        $find = $this->_repository->Find($id);
        if($find !== null)
        {
            $delete = $this->_repository->Delete($id);
            return $this->_responseUtil->GenerateResponse(true, null, null, null);
        }
        else
        {
            return $this->_responseUtil->GenerateResponse(false, null, null, ValidationMessages::CouldNotFindInitialObject);
        }
    }
}