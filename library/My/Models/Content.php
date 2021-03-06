<?php

namespace My\Models;

class Content extends ModelAbstract {

    private function getParentTable() {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        return new \My\Storage\storageContent($dbAdapter);
    }

    public function __construct() {
        $this->setTmpKeyCache('tmpContents');
        parent::__construct();
    }

    public function getList($arrCondition = array(), $strOrder, $arrFields) {
        return $this->getParentTable()->getList($arrCondition, $strOrder, $arrFields);
    }

    public function getListLimit($arrCondition, $intPage = 1, $intLimit = 10, $strOrder = 'cont_id DESC', $arrFields = '*') {
        $arrResult = $this->getParentTable()->getListLimit($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
        return $arrResult;
    }

    public function getListLimitJob($arrCondition, $intPage, $intLimit, $strOrder, $arrFields) {
        $arrResult = $this->getParentTable()->getListLimitJob($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
        return $arrResult;
    }

    public function getListLimitContent($arrCondition, $intPage, $intLimit, $strOrder = 'cont_id DESC', $arrFields = '*') {
        $keyCaching = 'getListLimitContent:' . $intPage . ':' . $intLimit . ':' . str_replace(' ', '_', $strOrder) . ':' . $this->cache->read($this->tmpKeyCache);
        if (count($arrCondition) > 0) {
            foreach ($arrCondition as $k => $val) {
                $keyCaching .= $k . ':' . $val . ':';
            }
        }
        $keyCaching = crc32($keyCaching);
        $arrResult = $this->cache->read($keyCaching);

        if (empty($arrResult)) {
            $arrResult = $this->getParentTable()->getListLimit($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
            $this->cache->add($keyCaching, $arrResult, 60 * 60 * 9);
        }
        return $arrResult;
    }

    public function getListHomePage($arrCondition, $intPage, $intLimit, $strOrder = 'cont_id DESC', $arrFields = '*') {
        $keyCaching = 'getListHomePage:' . $intPage . ':' . $intLimit . ':' . str_replace(' ', '_', $strOrder) . ':' . $this->cache->read($this->tmpKeyCache);
        if (count($arrCondition) > 0) {
            foreach ($arrCondition as $k => $val) {
                $keyCaching .= $k . ':' . $val . ':';
            }
        }
        $keyCaching = crc32($keyCaching);
        $arrResult = $this->cache->read($keyCaching);
        if (empty($arrResult)) {
            $arrResult = $this->getParentTable()->getListLimit($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
            $this->cache->add($keyCaching, $arrResult, 60 * 60 * 9);
        }
        return $arrResult;
    }

    public function getListHostContent($arrCondition, $intPage, $intLimit, $strOrder, $arrFields = '*') {
        $keyCaching = 'getListHostContent:' . $intPage . ':' . $intLimit . ':' . str_replace(' ', '_', $strOrder) . ':' . $this->cache->read($this->tmpKeyCache);
        if (count($arrCondition) > 0) {
            foreach ($arrCondition as $k => $val) {
                $keyCaching .= $k . ':' . $val . ':';
            }
        }
        $keyCaching = crc32($keyCaching);
        $arrResult = $this->cache->read($keyCaching);
        if (empty($arrResult)) {
            $arrResult = $this->getParentTable()->getListLimit($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
            $this->cache->add($keyCaching, $arrResult, 60 * 60 * 9);
        }
        return $arrResult;
    }

    public function getLimit($arrCondition = [], $intPage = 1, $intLimit = 15, $strOrder = 'cont_id DESC', $arrFields = '*') {
        $keyCaching = 'getLimitContent:' . $intPage . ':' . $intLimit . ':' . str_replace(' ', '_', $strOrder) . ':' . $this->cache->read($this->tmpKeyCache);
        if (count($arrCondition) > 0) {
            foreach ($arrCondition as $k => $val) {
                $keyCaching .= $k . ':' . $val . ':';
            }
        }
        $keyCaching = crc32($keyCaching);
        $arrResult = $this->cache->read($keyCaching);
        if (empty($arrResult)) {
            $arrResult = $this->getParentTable()->getLimit($arrCondition, $intPage, $intLimit, $strOrder, $arrFields);
            $this->cache->add($keyCaching, $arrResult, 60 * 60 * 9);
        }
        return $arrResult;
    }

    public function getLimitUnion($cateID) {
        return $this->getParentTable()->getLimitUnion($cateID);
    }

    public function getTotal($arrCondition) {
        return $this->getParentTable()->getTotal($arrCondition);
    }

    public function getDetail($arrCondition) {
        $arrResult = $this->getParentTable()->getDetail($arrCondition);
        return $arrResult;
    }

    public function add($p_arrParams) {
        $intResult = $this->getParentTable()->add($p_arrParams);
        if ($intResult) {
            $this->cache->increase($this->tmpKeyCache, 1);
        }
        return $intResult;
    }

    public function edit($p_arrParams, $intContentID) {
        $intResult = $this->getParentTable()->edit($p_arrParams, $intContentID);
        if ($intResult) {
            $this->cache->increase($this->tmpKeyCache, 1);
        }
        return $intResult;
    }

    public function editView($p_arrParams, $intContentID) {
        $intResult = $this->getParentTable()->edit($p_arrParams, $intContentID);
        return $intResult;
    }

}
