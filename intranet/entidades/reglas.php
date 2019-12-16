<?php

	class reglas {

		var $regla_id;
		var $indic1_id;
		var $indic2_id;
		var $formula;
		var $diag_id;

		public function getReglaID() {
			return $this->regla_id;
		}
		public function getIndic1ID() {
			return $this->indic1_id;
		}
		public function getIndic2ID() {
			return $this->indic2_id;
		}
		public function getFormula() {
			return $this->formula;
		}
		public function getDiagID() {
			return $this->diag_id;
		}

		public function setReglaID($regla_id) {
			$this->regla_id = $regla_id;
		}
		public function setIndic1ID($regla_indic1_id) {
			$this->indic1_id = $regla_indic1_id;
		}
		public function setIndic2ID($regla_indic2_id) {
			$this->indic2_id = $regla_indic2_id;
		}
		public function setFormula($regla_formula) {
			$this->formula = $regla_formula;
		}
		public function setDiagID($regla_diag_id) {
			$this->diag_id = $regla_diag_id;
		}
	}
