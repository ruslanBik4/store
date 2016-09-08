<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.08.16
 * Time: 19:43
 */
class Category
{
    const TABLE_NAME = 'category';
    // primary key, autoincrement
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;
    // integer, link by primary key parent category
    private $parentId;
    // handle соединения с БД
    static private $conn;

    public function __construct($name, $parentId = 0)
    {
        $this->name = $name;
        $this->parentId = $parentId;

    }

    /**
     * Определяем число записей в таблице
     * @return integer
     */
    static public function CountRecord()
    {
        return 'select count(*) from ' . self::TABLE_NAME;

    }
    /**

    /**
     * получение всех записей таблицы
     * @return bool|mysqli_result
     */
    static public function SelectAll()
    {
        return "select key_category as 'id', name from  " . self::TABLE_NAME;

    }
    /**
     * получение главны категорий
     * @return bool|mysqli_result
     */
    static public function SelectParent()
    {
        return "select key_category as 'id', name from " . self::TABLE_NAME . " where key_parent = 0 order by name";

    }
    /**
     * получение одной записи таблицы по ее $id
     * @param $id integer
     * @return bool|mysqli_result
     */
    public function fromID($id)
    {
        return "select key_category as 'id', name from " . self::TABLE_NAME . " where key_category = '$id'";
    }

    /**
     * получение одной записи таблицы по ее полю $name
     * @param $name string
     * @return bool|mysqli_result
     */
    public function fromName($name)
    {
        return "select * from " . self::TABLE_NAME . " where name = $name";
    }

    /**
     * получение одной записи таблицы по ее полю $name
     * @param $name string
     * @return bool|mysqli_result
     */
    public function fromParent($parameters)
    {
        $where = $separator = '';
        foreach ($parameters as $key => $value) {

            $where .= "$separator $key = '$value'";

            $separator = ' AND ';

        }
        return "select * from " . self::TABLE_NAME . " where $where";
    }

    /**
     * отбор записей по условиям в массиве $arrSearch
     *  fromBY( [ 'name' => 'Dmitro', 'address' => [ 'ot' => 'Bruclin', 'do' => 'Moskau' ] ])
     * @param array $arrSearch
     * @return bool|mysqli_result
     */
    public function fromBy(array $arrSearch)
    {
        $sql = 'select * from " . self::TABLE_NAME . " where ';
        $separator = '';

        foreach ($arrSearch as $key => $value) {
            if (is_array($value) ) {
                foreach ($value as $key => $arrow) {
                    switch ($key) {
                        case 'ot':
                            $sql .= "$separator $key < $value";
                    }
                }
            }
            else
                $sql .= "$separator $key = $value";
            $separator = ' AND ';
        }

        return $sql;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}