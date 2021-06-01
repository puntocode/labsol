/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!*******************************************************!*\
  !*** ../demo7/src/js/pages/custom/wizard/wizard-2.js ***!
  \*******************************************************/


// Class definition
var KTWizard2 = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizardObj;
	var _validations = [];

	// Private functions
	var _initWizard = function () {
		// Initialize form wizard
		_wizardObj = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
		});

		// Validation before going to next page
		_wizardObj.on('change', function (wizard) {
			if (wizard.getStep() > wizard.getNewStep()) {
				return; // Skip if stepped back
			}

			// Validate form before change wizard step
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						wizard.goTo(wizard.getNewStep());

						KTUtil.scrollTop();
					} else {
						// Swal.fire({
						// 	text: "Complete los campos obligatorio",
						// 	icon: "error",
						// 	buttonsStyling: false,
						// 	confirmButtonText: "Aceptar",
						// 	customClass: {
						// 		confirmButton: "btn font-weight-bold btn-light"
						// 	}
						// }).then(function () {
							KTUtil.scrollTop();
						// });
					}
				});
			}

			return false;  // Do not change wizard step, further action will be handled by he validator
		});

		// Change event
		_wizardObj.on('changed', function (wizard) {
			KTUtil.scrollTop();
		});

		// Submit event
		_wizardObj.on('submit', function (wizard) {
			Swal.fire({
				text: "¿Desea guardar los datos?",
				// icon: "success",
				showCancelButton: true,
				buttonsStyling: false,
				confirmButtonText: "Guardar",
				cancelButtonText: "Cancelar",
				customClass: {
					confirmButton: "btn font-weight-bold btn-primary",
					cancelButton: "btn font-weight-bold btn-default"
				}
			}).then(function (result) {
				if (result.value) {
					_formEl.submit(); // Submit form
				} else if (result.dismiss === 'cancel') {
					Swal.fire({
						text: "Datos no guardados",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Aceptar",
						customClass: {
							confirmButton: "btn font-weight-bold btn-primary",
						}
					});
				}
			});
		});
	}

	var _initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					nro_expediente: {
						validators: {
							notEmpty: {
								message: 'Nro. de expediente es obligatorio'
							}
						}
					}

				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					solicitante1: {
						validators: {
							notEmpty: {
								message: 'Solicitante es obligatorio'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					identificacion: {
						validators: {
							notEmpty: {
								message: 'Identificación es obligatorio'
							}
						}
					},
					intervalo: {
						validators: {
							notEmpty: {
								message: 'Intervalo es obligatorio'
							}
						}
					},
					resolucion: {
						validators: {
							notEmpty: {
								message: 'Resolución es obligatorio'
							}
						}
					},
					tipo: {
						validators: {
							notEmpty: {
								message: 'Tipo es obligatorio'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 4
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					patron1: {
						validators: {
							notEmpty: {
								message: 'Patrón es obligatorio'
							}
						}
					}

				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 5
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					fecha_calibracion: {
						validators: {
							notEmpty: {
								message: 'Fecha de calibración es obligatorio'
							}
						}
					},
					lugar: {
						validators: {
							notEmpty: {
								message: 'Lugar es obligatorio'
							}
						}
					},
					temperatura: {
						validators: {
							notEmpty: {
								message: 'Temperatura es obligatorio'
							}
						}
					},
					humedad_relativa: {
						validators: {
							notEmpty: {
								message: 'Humedad relativa es obligatorio'
							}
						}
					},
					procedimiento: {
						validators: {
							notEmpty: {
								message: 'Procedimiento es obligatorio'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 6
		_validations.push(FormValidation.formValidation(
			_formEl,
			{

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));
		// Step 7
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					temperatura_final: {
						validators: {
							notEmpty: {
								message: 'Temperatura final es obligatorio'
							}
						}
					},
					humedad_final: {
						validators: {
							notEmpty: {
								message: 'Humedad relativa final es obligatorio'
							}
						}
					}

				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));
		// Step 8
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					firma: {
						validators: {
							notEmpty: {
								message: 'Firma es obligatorio'
							}
						}
					}

				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard');
			_formEl = KTUtil.getById('kt_form');

			_initWizard();
			_initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard2.init();
});

/******/ })()
;
//# sourceMappingURL=wizard-2.js.map
