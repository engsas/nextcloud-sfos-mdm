<?php
namespace OCA\SailfishMDM\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\QBMapper;

class SysinfoMapper extends QBMapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'sailfishmdm_sysinfo', Sysinfo::class);
    }

    public function find(int $id, string $userId) {
        $qb = $this->db->getQueryBuilder();

                    $qb->select('*')
                             ->from($this->getTableName())
                             ->where(
                                     $qb->expr()->eq('id', $qb->createNamedParameter($id))
                             )->andWhere(
             $qb->expr()->eq('user_id', $qb->createNamedParameter($userId))
           );

        return $this->findEntity($qb);
    }

    public function findAll(string $userId = null) {
        $qb = $this->db->getQueryBuilder();

        if is_null($userId ) {
            $qb->select('*')
            ->from($this->getTableName());
        }
        else{
            $qb->select('*')
            ->from($this->getTableName())
            ->where(
                $qb->expr()->eq('user_id', $qb->createNamedParameter($userId))
            );
        }
        return $this->findEntities($qb);
    }

}
