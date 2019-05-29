<?php

namespace AppBundle\Service\Pagination;

class Column
{
    const IS_LIKE = 1;
    const IS_EQUALS = 2;
    const IS_STRING = 1;
    const IS_NUMERIC = 2;

    private $db;
    private $dt;
    private $dtNum;
    private $equalsOrLike = Column::IS_LIKE;
    private $numericOrString = Column::IS_STRING;
    private $cf;

    public function __construct(
        string $db , //column title in database table
        string $dt,  //column title in html table
        int $dtNum = 0, //column number in html table
        int $equalsOrLike = self::IS_LIKE,
        int $numericOrString = self::IS_NUMERIC,
        string $cf = null //column search title in database table
    )
    {
        $this->db = $db;
        $this->dt = $dt;
        $this->dtNum = $dtNum;
        $this->equalsOrLike = $equalsOrLike;
        $this->numericOrString = $numericOrString;
        if($cf){
            $this->cf = $cf;
        }else{
            $this->cf = $db;
        }
    }

    public function bindWhere($search)
    {
        if($this->getNumericOrString() == Column::IS_LIKE){
            $search = "%$search%";
        }
        if($this->getNumericOrString() == Column::IS_STRING){
            $search = "'$search'";
        }

        $whereOrLike = $this->equalsOrLike == self::IS_LIKE ? "like" : "=";

        return $this->getCf()." $whereOrLike ".$search;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }
    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getDt()
    {
        return $this->dt;
    }
    /**
     * @param mixed $dt
     */
    public function setDt($dt)
    {
        $this->dt = $dt;
    }

    /**
     * @return int
     */
    public function getEqualsOrLike()
    {
        return $this->equalsOrLike;
    }
    /**
     * @param int $equalsOrLike
     */
    public function setEqualsOrLike($equalsOrLike)
    {
        $this->equalsOrLike = $equalsOrLike;
    }

    /**
     * @return int
     */
    public function getNumericOrString()
    {
        return $this->numericOrString;
    }
    /**
     * @param int $numericOrString
     */
    public function setNumericOrString($numericOrString)
    {
        $this->numericOrString = $numericOrString;
    }

    /**
     * @return mixed
     */
    public function getDtNum()
    {
        return $this->dtNum;
    }
    /**
     * @param mixed $dtNum
     */
    public function setDtNum($dtNum)
    {
        $this->dtNum = $dtNum;
    }

    /**
     * @return mixed
     */
    public function getCf()
    {
        return $this->cf;
    }
    /**
     * @param mixed $cf
     */
    public function setCf($cf)
    {
        $this->cf = $cf;
    }
}