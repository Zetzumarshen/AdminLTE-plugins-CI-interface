<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 2016-09-26
 * Time: 11:36 AM
 */
class Morris_Line
{
    var $xKey = NULL;

    var $yKeys = NULL;

    var $data = NULL;

    var $labels = NULL;

    /**
     * @var CI_DB_result
     */
    var $data_set;

    /**
     * Morris_line_data_row constructor.
     * TODO: decoupled by implementing IDatabase interface
     * @param CI_DB_result
     */
    public function __construct(CI_DB_result $ci_db_result = NULL)
    {
        $this->data_set = $ci_db_result;
    }

    protected function set_xKey()
    {
        // set xKey using returned pdo set with column numbers > 0
        $this->xKey = $this->data_set->list_fields()[0];
    }

    protected function set_yKeys()
    {
        // set yKeys using returned pdo set with column numbers > 0
        $fields = $this->data_set->list_fields();
        for ($i = 1; $i < sizeof($fields); $i++) {
            $this->yKeys[] = $fields[$i];
        }
    }

    protected function set_data()
    {
        $this->data = $this->data_set->result();
    }

    public function set_labels($labels = NULL)
    {
        if (!$labels) {
            $this->labels = $this->yKeys;
        } else {
            foreach ($labels as $label) {
                $this->labels[] = $label;
            }
        }
    }

    public function get_data()
    {
        // set required data for morrisjs
        $this->set_xKey();
        $this->set_yKeys();
        $this->set_data();
        if ($this->labels === NULL) {
            $this->set_labels();
        }

        // unset the data object
        unset($this->data_set);

        return json_encode($this, JSON_PRETTY_PRINT);
    }
}