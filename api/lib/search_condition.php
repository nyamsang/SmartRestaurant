<?php
class SearchCondition {
    private $fieldName;
    private $valueList;
    
    public function __construct($fieldName, $valueList) {
        $this->fieldName = $fieldName;
        $this->valueList = $valueList;
    }
    
    public function getFieldName() {
        return $this->fieldName;
    }
    
    public function getValueList() {
        return $this->valueList;
    }
}
