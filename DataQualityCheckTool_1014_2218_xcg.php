<?php
// 代码生成时间: 2025-10-14 22:18:44
class DataQualityCheckTool extends \yii\base\Component
{
    /**
     * @var array The rules for data quality checks
     */
    public $rules = [];

    /**
     * Constructor
     *
     * Initializes the data quality check tool with rules.
     *
     * @param array $rules The rules for data quality checks
     */
    public function __construct($rules = [])
    {
        $this->rules = $rules;
        parent::__construct();
    }

    /**
     * Perform data quality checks
     *
     * This method takes input data and applies the defined rules to check for data quality.
     *
     * @param mixed $data The input data to be checked
     * @return bool Returns true if the data passes all checks, false otherwise
     */
    public function check($data)
    {
        foreach ($this->rules as $rule) {
            if (!$this->applyRule($data, $rule)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Apply a single rule to the data
     *
     * This method applies a single rule to the data and returns the result.
     *
     * @param mixed $data The input data
     * @param array $rule The rule to apply
     * @return bool Returns true if the data passes the rule, false otherwise
     */
    protected function applyRule($data, $rule)
    {
        // Check if the rule has a 'field' key
        if (!isset($rule['field'])) {
            throw new \yii\base\InvalidConfigException('Rule must have a 