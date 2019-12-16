<?php

	class percentil {

		var $percent_id;
		var $sexo;
		var $indic_id;
		var $var1_valor;
		var $var2_valor;
		var $percentil;
		var $estado;

		public function getPercentID() {
			return $this->percent_id;
		}
		public function getSexo() {
			return $this->sexo;
		}
		public function getIndicID() {
			return $this->indic_id;
		}
		public function getVar1Valor() {
			return $this->var1_valor;
		}
		public function getVar2Valor() {
			return $this->var2_valor;
		}
		public function getPercentil() {
			return $this->percentil;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setPercentID($percent_id) {
			$this->percent_id = $percent_id;
		}
		public function setSexo($percent_sexo) {
			$this->sexo = $percent_sexo;
		}
		public function setIndicID($percent_indic_id) {
			$this->indic_id = $percent_indic_id;
		}
		public function setVar1Valor($percent_var1_valor) {
			$this->var1_valor = $percent_var1_valor;
		}
		public function setVar2Valor($percent_var2_valor) {
			$this->var2_valor = $percent_var2_valor;
		}
		public function setPercentil($percent_percentil) {
			$this->percentil = $percent_percentil;
		}
		public function setEstado($percent_estado) {
			$this->estado = $percent_estado;
		}
	}
