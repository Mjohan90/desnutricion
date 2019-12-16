<?php

	class triaje {

		var $triaje_id;
		var $atenc_id;
		var $var_id;
		var $um_id;
		var $valor;
		var $escala;
		var $fecha_reg;
		var $estado;

		public function getTriajeID() {
			return $this->triaje_id;
		}
		public function getAtencID() {
			return $this->atenc_id;
		}
		public function getVarID() {
			return $this->var_id;
		}
		public function getUmID() {
			return $this->um_id;
		}
		public function getValor() {
			return $this->valor;
		}
		public function getEscala() {
			return $this->escala;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setTriajeID($triaje_id) {
			$this->triaje_id = $triaje_id;
		}
		public function setAtencID($triaje_atenc_id) {
			$this->atenc_id = $triaje_atenc_id;
		}
		public function setVarID($triaje_var_id) {
			$this->var_id = $triaje_var_id;
		}
		public function setUmID($triaje_um_id) {
			$this->um_id = $triaje_um_id;
		}
		public function setValor($triaje_valor) {
			$this->valor = $triaje_valor;
		}
		public function setEscala($triaje_escala) {
			$this->escala = $triaje_escala;
		}
		public function setFechaReg($triaje_fecha_reg) {
			$this->fecha_reg = $triaje_fecha_reg;
		}
		public function setEstado($triaje_estado) {
			$this->estado = $triaje_estado;
		}
	}
