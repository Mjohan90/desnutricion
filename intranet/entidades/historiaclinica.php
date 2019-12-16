<?php

	class historiaclinica {

		var $hc_id;
		var $pac_id;
		var $fecha_suceso;
		var $comentario;
		var $atenc_id_ref;
		var $fecha_reg;
		var $estado;

		public function getHcID() {
			return $this->hc_id;
		}
		public function getPacID() {
			return $this->pac_id;
		}
		public function getFechaSuceso() {
			return $this->fecha_suceso;
		}
		public function getComentario() {
			return $this->comentario;
		}
		public function getAtencIDRef() {
			return $this->atenc_id_ref;
		}
		public function getFechaReg() {
			return $this->fecha_reg;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setHcID($hc_id) {
			$this->hc_id = $hc_id;
		}
		public function setPacID($hc_pac_id) {
			$this->pac_id = $hc_pac_id;
		}
		public function setFechaSuceso($hc_fecha_suceso) {
			$this->fecha_suceso = $hc_fecha_suceso;
		}
		public function setComentario($hc_comentario) {
			$this->comentario = $hc_comentario;
		}
		public function setAtencIDRef($hc_atenc_id_ref) {
			$this->atenc_id_ref = $hc_atenc_id_ref;
		}
		public function setFechaReg($hc_fecha_reg) {
			$this->fecha_reg = $hc_fecha_reg;
		}
		public function setEstado($hc_estado) {
			$this->estado = $hc_estado;
		}
	}
