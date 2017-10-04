<?php
//joe
class CRUD{
    private $_mysqli;

    /*
     * @param object $mysqli
     */
    public function __construct($mysqli)
    {
        $this->_mysqli = $mysqli;
    }

    /*
     * @param string query
     * @param string $types
     * @param array $values
     */
    public function create($query = "", $type = "", $params = array())
    {
        $query = ($query === "") ? die("Create error: Query") : $query;
        $type = ($type === "") ? die("Create error: Type") : array($type);
        $params = (count($params) == 0) ? die("Create error: Params") : $params;

        $values = array();
        foreach($params as $key => $value) {
            $values[$key] = &$params[$key];
        }

        if ($stmt = $this->_mysqli->prepare($query))
        {
            call_user_func_array(array($stmt, "bind_param"), array_merge($type, $values));
            $stmt->execute();
        }

        $stmt->close();
    }

    /*
     * @param string query
     * @param string $types
     * @param array $values
     */
    public function read($query = "", $type = "", $params = array())
    {
        $query = ($query === "") ? die("Read error: Query") : $query;
        $type = ($type === "") ? die("Read error: Type") : array($type);
        $params = (count($params) == 0) ? die("Read error: Params") : $params;

        $values = array();
        foreach($params as $key => $value) {
            $values[$key] = &$params[$key];
        }

        if ($stmt = $this->_mysqli->prepare($query))
        {
            call_user_func_array(array($stmt, "bind_param"), array_merge($type, $values));
            $stmt->execute();

            $meta = $stmt->result_metadata();
//            $fields = [];
            while ($field = $meta->fetch_field()) {
                $var = $field->name;
                $$var = null;
                $fields[$field->name] = &$$var;
            }
            call_user_func_array(array($stmt, "bind_result"), $fields);

            while($stmt->fetch())
            {
                return $fields;
            }

            $stmt->close();
        }
    }

    /*
     * @param string query
     * @param string $types
     * @param array $values
     */
    public function update($query = "", $type = "", $params = array())
    {
        $query = ($query === "") ? die("Update error: Query") : $query;
        $type = ($type === "") ? die("Update error: Type") : array($type);
        $params = (count($params) == 0) ? die("Update error: Params") : $params;

        $values = array();
        foreach($params as $key => $value) {
            $values[$key] = &$params[$key];
        }

        if ($stmt = $this->_mysqli->prepare($query))
        {
            call_user_func_array(array($stmt, "bind_param"), array_merge($type, $values));
            $stmt->execute();
        }
        $stmt->close();
    }

    /*
     * @param string query
     * @param string $types
     * @param array $values
     */
    public function delete($query = "", $type = "", $params = array())
    {
        $query = ($query === "") ? die("Delete error: Query") : $query;
        $type = ($type === "") ? die("Delete error: Type") : array($type);
        $params = (count($params) == 0) ? die("Delete error: Params") : $params;

        $values = array();
        foreach($params as $key => $value) {
            $values[$key] = &$params[$key];
        }

        if ($stmt = $this->_mysqli->prepare($query))
        {
            call_user_func_array(array($stmt, "bind_param"), array_merge($type, $values));
            $stmt->execute();
        }
        $stmt->close();
    }

    /*
     * @param string query
     */
    public function query($query = "")
    {
        $query = ($query === "") ? die("Query error: Query") : $query;

        if ($result = $this->_mysqli->query($query))
        {
            $array = array();
            while ($row = $result->fetch_assoc())
            {
                $array[] = $row;
            }
            return $array;
        }
    }
}
?>