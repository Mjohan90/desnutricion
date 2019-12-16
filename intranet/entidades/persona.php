<?php

	class persona {

		var $pers_id;
		var $nombre;
		var $snombre;
		var $ap_paterno;
		var $ap_materno;
		var $tdi_id;
		var $tdi_nro;
		var $sexo;
		var $fecha_nac;
		var $email;
		var $celular;
		var $telefono;
		var $ubig_id;
		var $direccion;
		var $estado;

		public function getPersID() {
			return $this->pers_id;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getSnombre() {
			return $this->snombre;
		}
		public function getApPaterno() {
			return $this->ap_paterno;
		}
		public function getApMaterno() {
			return $this->ap_materno;
		}
		public function getTdiID() {
			return $this->tdi_id;
		}
		public function getTdiNro() {
			return $this->tdi_nro;
		}
		public function getSexo() {
			return $this->sexo;
		}
		public function getFechaNac() {
			return $this->fecha_nac;
		}
		public function getEmail() {
			return $this->email;
		}
		public function getCelular() {
			return $this->celular;
		}
		public function getTelefono() {
			return $this->telefono;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setPersID($pers_id) {
			$this->pers_id = $pers_id;
		}
		public function setNombre($pers_nombre) {
			$this->nombre = $pers_nombre;
		}
		public function setSnombre($pers_snombre) {
			$this->snombre = $pers_snombre;
		}
		public function setApPaterno($pers_ap_paterno) {
			$this->ap_paterno = $pers_ap_paterno;
		}
		public function setApMaterno($pers_ap_materno) {
			$this->ap_materno = $pers_ap_materno;
		}
		public function setTdiID($pers_tdi_id) {
			$this->tdi_id = $pers_tdi_id;
		}
		public function setTdiNro($pers_tdi_nro) {
			$this->tdi_nro = $pers_tdi_nro;
		}
		public function setSexo($pers_sexo) {
			$this->sexo = $pers_sexo;
		}
		public function setFechaNac($pers_fecha_nac) {
			$this->fecha_nac = $pers_fecha_nac;
		}
		public function setEmail($pers_email) {
			$this->email = $pers_email;
		}
		public function setCelular($pers_celular) {
			$this->celular = $pers_celular;
		}
		public function setTelefono($pers_telefono) {
			$this->telefono = $pers_telefono;
		}
		public function setEstado($pers_estado) {
			$this->estado = $pers_estado;
		}
	}
