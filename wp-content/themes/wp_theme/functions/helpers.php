<?php

if (!function_exists('writeToLog')) {
    /**
     * Write content in log file
     * @param $log
     */
    function writeToLog($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

if (!function_exists('getOptionFieldsFromACF')) {
    /**
     * Convert data in custom format
     * @param array $options
     * @param string $parentFieldName
     * @return array
     */
    function getOptionFieldsFromACF(array $options, string $parentFieldName = ''):array
    {
        $fields = [];
        $fieldsTemp = [];
        $parent = $parentFieldName;
        $parentInner = '';

        foreach ($options as $option) {
            if ($option['type'] === 'tab') {
                continue;
            }

            if ($option['type'] === 'group') {
                $parent = $option['name'];

                if (!empty($option['sub_fields'])) {
                    foreach ($option['sub_fields'] as $sub_field) {
                        if ($sub_field['type'] === 'group') {
                            $parentInner = $parent . '_' . $sub_field['name'];
                        } else {
                            $parentInner = $parent;
                        }

                        if (empty($sub_field['sub_fields']))  {
                            if (!in_array($sub_field['type'], ['tab', 'group'])) {
                                $fields[$sub_field['ID']]['name']       =   $sub_field['name'];
                                $fields[$sub_field['ID']]['key']        =   $sub_field['key'];
                                $fields[$sub_field['ID']]['full_name']  =   $parentInner . '_' . $sub_field['name'];
                            }
                        } else {
                            $data       =   getOptionFieldsFromACF($sub_field['sub_fields'], $parentInner);
                            $fieldsTemp =   array_merge($fields, $data);
                            $fields     =   $fieldsTemp;
                        }
                    }
                }
            } else {
                $fields[$option['ID']]['name']       =   $option['name'];
                $fields[$option['ID']]['key']        =   $option['key'];
                $fields[$option['ID']]['full_name']  =   $parent . '_' . $option['name'];
            }
        }

        return $fields;
    }
}