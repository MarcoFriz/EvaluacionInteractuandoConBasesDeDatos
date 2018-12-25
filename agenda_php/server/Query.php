<?php

class Query
{

    public function __construct($host, $user, $password, $base)
    {
        $db = new mysqli($host, $user, $password, $base);
        $db->set_charset("utf8");
        $GLOBALS["db"] = $db;
    }

    // TOOLS ------------------------------------------------
    /**
     *
     * @param string $tableName
     * @param string $fieldName
     * @param string $fieldValue
     * @return \mysqli_result
     */
    static function Search($tableName, $fieldName, $fieldValue)
    {
        global $db;
        $sql = "SELECT * FROM $tableName WHERE $fieldName='$fieldValue'";
        return $db->query($sql);
    }

    static function SearchAll($tableName)
    {
        global $db;
        $sql = "SELECT * FROM $tableName";
        return $db->query($sql);
    }

    static function SearchFiltered($tableName, $params)
    {
        global $db;
        $sql = "SELECT * FROM $tableName WHERE $params";
        return $db->query($sql);
    }

    /**
     *
     * @param string $tableName
     * @param string $fieldName
     * @param string $fieldValue
     * @param array $data
     *            array asociativa con "nombreCampo" => "valorCampo"
     * @return boolean True si se actualiza, false si no
     */
    static function Update($tableName, $fieldName, $fieldValue, $data)
    {
        global $db;
        $query = "UPDATE $tableName SET ";
        $i = 0;
        $max = count($data);
        //
        foreach ($data as $key => $value) {
            if ($value != NULL)
                $query .= "$key = '$value' ";
            else
                $query .= "$key = NULL ";

            if ($i < $max - 1) {
                $query .= " ,";
            }
            $i ++;
        }
        $query .= " WHERE `$fieldName` = \"$fieldValue\"";
        $result = $db->query($query);
        return $result;
    }

    public static function Remove($tableName, $fieldName, $fieldValue)
    {
        global $db;
        $query = "DELETE FROM `$tableName` WHERE `$fieldName`= \"$fieldValue\" ";
        $result = $db->query($query);
        return $result;
    }

    /**
     * *
     *
     * @param array $data
     *            ["key"=>"value","key"=>"value","key"=>"value"]
     */
    public static function Insert($tableName, $data)
    {
        global $db;
        $query = "INSERT INTO $tableName (";
        $i = 0;
        $max = count($data);
        //
        $i = 0;
        foreach ($data as $key => $value) {
            $query .= "`$key` ";
            if ($i < $max - 1) {
                $query .= " ,";
            }
            $i ++;
        }
        $query .= ") VALUES (";
        $i = 0;
        foreach ($data as $key => $value) {
            $query .= "\"$value\" ";
            if ($i < $max - 1) {
                $query .= " ,";
            }
            $i ++;
        }
        $query .= ")";
        return $db->query($query);
    }

    /**
     * $data[keys[n], pairs[m]];
     */
    public static function InsertPairs($tableName, $data)
    {
        global $db;
        $query = "INSERT INTO $tableName (";
        $i = 0;
        $max = count($data);
        //
        $i = 0;
        foreach ($data["keys"] as $value) {
            $query .= "`$value`";
            if ($i < $max - 1) {
                $query .= ", ";
            }
            $i ++;
        }
        $query .= ") VALUES ";
        $n = $i;
        $j = 0;
        $m = count($data["pairs"]);
        foreach ($data["pairs"] as $value) {
            $query .= "(";
            $i = 0;
            foreach ($value as $pair) {
                $query .= "\"$pair\"";
                if ($i < $n - 1) {
                    $query .= ",";
                }
                $i ++;
            }
            $query .= ")";
            if ($j < $m - 1) {
                $query .= ",";
            }
            $j ++;
        }
        return $db->query($query);
    }

    public static function Close()
    {
        global $db;
        return $db->close();
    }

    // ------------------------------------------
    /**
     *
     * @param \mysqli_result $result
     * @return array
     */
    public static function ConvertInAssocMultyDimensionalArray($result)
    {
        $output = [];
        $n = 0;
        while ($row = $result->fetch_assoc()) {
            $output[$n] = $row;
            $n ++;
        }
        return $output;
    }

    // ------------------------------------------
    public static function LastId()
    {
        global $db;
        return $db->error;
    }

    // ------------------------------------------
    public static function error()
    {
        global $db;
        return $db->error;
    }
}

