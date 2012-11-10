<?php
/**
 * PHP Version 5
 *
 * @category Lap
 * @package Entity
 * @author Chabert Loic <chabert.loic.74@gmail.com>
 * @license http://github.com/lolostates/Lap/blob/master/LICENSE
 * @link https://github.com/lolostates/Lap
 *
 * Copyright 2012 Chabert Loic <chabert.loic.74@gmail.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License*
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Lap\AsteriskBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of CdrRepository
 *
 * @author lolostates
 */
class CdrRepository extends EntityRepository {

	public function findCdrByCallerId($callerid) {
		return $this->createQueryBuilder('c')->where('c.dst = :callerid')
				->orWhere('c.src = :callerid')
				->setParameter('callerid', $callerid)
				->addOrderBy('c.calldate', 'ASC')
				->andWhere('c.calldate BETWEEN :debut AND :fin')
				->setParameter('debut', new \Datetime(date("Y-m-d")))
				->setParameter('fin',
						new \Datetime(date("Y-m-d", strtotime("+1 week"))))
				->getQuery()->getResult();
	}
}

?>
