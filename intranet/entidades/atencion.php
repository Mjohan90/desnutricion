<?php

	class atencion {

		var $atenc_id;
		var $pac_id;
		var $medico_id;
		var $espec_id;
		var $fecha_atenc;
		var $observacion;
		var $tratamiento;
		var $dieta;
		var $situacion;
		var $registra_id;
		var $fecha_reg;
		var $estado;

		public function getAtencID() {
			return $this->atenc_id;
		}
		public function getPacID() {
			return $this->pac_id;
		}
		public function getMedicoID() {
			return $this->medico_id;
		}
		public function getEspecID() {
			return $this->espec_id;
		}
		public function getFechaAtenc() {
			return $this->fecha_atenc;
		}
		public function getObservacion() {
			return $this->observacion;
		}
		public function getTratamiento() {
			return $this->tratamiento;
		}
		public function getDieta() {
			return $this->dieta;
		}
		public function getSituacion() {
			return $this->situacion;
		}
		public function getRegistraID() {
			return $this->registra_id;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setAtencID($atenc_id) {
			$this->atenc_id = $atenc_id;
		}
		public function setPacID($atenc_pac_id) {
			$this->pac_id = $atenc_pac_id;
		}
		public function setMedicoID($atenc_medico_id) {
			$this->medico_id = $atenc_medico_id;
		}
		public function setEspecID($atenc_espec_id) {
			$this->espec_id = $atenc_espec_id;
		}
		public function setFechaAtenc($atenc_fecha_atenc) {
			$this->fecha_atenc = $atenc_fecha_atenc;
		}
		public function setObservacion($atenc_observacion) {
			$this->observacion = $atenc_observacion;
		}
		public function setTratamiento($atenc_tratamiento) {
			$this->tratamiento = $atenc_tratamiento;
		}
		public function setDieta($atenc_dieta) {
			$this->dieta = $atenc_dieta;
		}
		public function setSituacion($atenc_situacion) {
			$this->situacion = $atenc_situacion;
		}
		public function setRegistraID($atenc_registra_id) {
			$this->registra_id = $atenc_registra_id;
		}
		public function setFechaReg($atenc_fecha_reg) {
			$this->fecha_reg = $atenc_fecha_reg;
		}
		public function setEstado($atenc_estado) {
			$this->estado = $atenc_estado;
		}
	}
