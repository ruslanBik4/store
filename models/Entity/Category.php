<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.08.16
 * Time: 19:43
 */
class Category
{
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

    private $conn;

    public function __construct($name, $parentId = 0)
    {
        $this->name = $name;
        $this->parentId = $parentId;
        $this->conn = mysqli_connect();

    }

    static public function SelectAll()
    {
        $sql = 'select * from category';

        $result = mysqli_query( $this->conn, $sql );

        return $result;

    }
    public function fromID($id)
    {
        $sql = 'select * from category where id = ?';

        mysqli_query( $this->conn, $sql, $id );

        return $foundCategory;
    }

    public function fromName($name)
    {
        $sql = 'select * from category where name = ?';

        $foundCategory = mysqli_query( $conn, $sql, $name );

        return $foundCategory;
    }

    /**
     *  fromBY( [ 'name' => 'Dmitro', 'address' => [ 'ot' => 'Bruclin', 'do' => 'Moskau' ] ])
     * @param array $arrSearch
     * @return bool|mysqli_result
     */
    public function fromBy(array $arrSearch)
    {
        $sql = 'select * from category where ';
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

        $foundCategory = mysqli_query( $this->conn, $sql );

        return $foundCategory;
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