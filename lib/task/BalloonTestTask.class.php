<?php

/*
 * This file is part of the balloon project.
 * (c) 2011 Clément JOBEILI
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * BalloonTestTask build dev database, drop test database, reinject database in test and launch unittesting.
 * 
 * ./symfony doctrine:build --all && ./symfony doctrine:drop-db --env="test" && ./symfony doctrine:create-db --env="test" && ./symfony doctrine:insert-sql --env="test" && ./symfony test:unit
 *
 * @package    balloon project
 * @subpackage class
 * @author     Clément JOBEILI
 * @version    1.0.0
 */
class BalloonTestTask extends sfBaseTask
{
	protected function configure()
  {
    $this->namespace = 'balloon';
    $this->name = 'test';
    $this->briefDescription = 'build dev database, drop test database, reinject database in test and launch unittesting';
  }

	protected function execute($arguments = array(), $options = array())
  {
		$task = new sfDoctrineBuildTask($this->dispatcher, $this->formatter);
    $task->run(array(), array('env' => 'dev', 'all' => true, 'no-confirmation' => true));

		$task = new sfDoctrineDropDbTask($this->dispatcher, $this->formatter);
    $task->run(array(), array('env' => 'test', 'no-confirmation' => true));

		$task = new sfDoctrineBuildDbTask($this->dispatcher, $this->formatter);
    $task->run(array(), array('env' => 'test'));

		$task = new sfDoctrineInsertSqlTask($this->dispatcher, $this->formatter);
    $task->run(array(), array('env' => 'test'));

		$task = new sfTestUnitTask($this->dispatcher, $this->formatter);
    $task->run(array(), array());
  }
}