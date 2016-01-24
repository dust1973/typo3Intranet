<?php
class Tx_EventNews_Domain_Model_NewsDefault 
    extends Tx_News_Domain_Model_NewsDefault
{
        /**
         * the new field
         * @var string
         */
        protected $newField;
        
        /**
         * Returns an array of orderings created from a given demand object.
         *
         * @param string $newField
         * @return void
         */
        public function setNewField($newField) {
                $this->newField = $newField;
        }
        /**
         * Get new field
         *
         * @return string
         */
        public function getNewField() {
                return $this->newField;
        }
}
?>
