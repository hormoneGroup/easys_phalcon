<?php 

namespace Phalcon\Mvc\Model {

	class Transaction implements \Phalcon\Mvc\Model\TransactionInterface {

		protected $_connection;

		protected $_activeTransaction;

		protected $_isNewTransaction;

		protected $_rollbackOnAbort;

		protected $_manager;

		protected $_messages;

		protected $_rollbackRecord;

		public function __construct(\Phalcon\DiInterface $dependencyInjector, $autoBegin=null, $service=null){ }


		public function setTransactionManager(\Phalcon\Mvc\Model\Transaction\ManagerInterface $manager){ }


		public function begin(){ }


		public function commit(){ }


		public function rollback($rollbackMessage=null, $rollbackRecord=null){ }


		public function getConnection(){ }


		public function setIsNewTransaction($isNew){ }


		public function setRollbackOnAbort($rollbackOnAbort){ }


		public function isManaged(){ }


		public function getMessages(){ }


		public function isValid(){ }


		public function setRollbackedRecord(\Phalcon\Mvc\ModelInterface $record){ }

	}
}
