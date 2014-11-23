$(document).ready(function(){

    $('#loginForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user:{
                validators: {
                    notEmpty: {
                        message: 'Se requiere digitar el nombre de usuario para ingresar.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'El nombre de usuario sólo puede contener caracteres alfabéticos.'
                    }
                }
            }
        }
    });

    $('#passwordRegistrationForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        live: 'disabled',
        fields: {
            codigo:{
                validators: {
                    notEmpty: {
                        message: 'Se requiere digitar el código uninorte para ingresar.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'El código uninorte sólo puede contener números.'
                    }
                }
            },
            pass:{
                message: 'La contraseña debe tener al menos seis letras y/o números.',
                validators: {
                    notEmpty: {
                        message: 'Se requiere digitar la contraseña para continuar.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'La contraseña sólo puede contener letras y/o números.'
                    },
                    stringLength: {
                        min: 6,
                        message: 'La contraseña debe tener al menos seis letras y/o números.'
                    },
                    identical: {
                        field: 'pass2',
                        message: 'La contraseña no coincide con la confirmación.'
                    }              
                }
            },
            pass2:{
                message: 'Se han presentado errores al confirmar la contraseña.',
                validators: {
                    notEmpty: {
                        message: 'Se requiere confirmar la contraseña para continuar.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'La contraseña sólo puede contener letras y/o números.'
                    },
                    stringLength: {
                        min: 6,
                        message: 'La contraseña debe tener al menos seis letras y/o números.'
                    },
                    identical: {
                        field: 'pass',
                        message: 'La contraseña a confirmar no coincide con la digitada anteriormente.'
                    }          
                }
            }
        }
    });

    $('#courseCreationForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            subjectName:{
                validators: {
                    notEmpty: {
                        message: 'La materia debe tener un nombre.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúüñÁÉÍÓÚÜÑ\s]+$/,
                        message: 'La materia sólo puede contener letras, números y/o espacios en blanco.'
                    }
                }
            },
            nrc:{
                validators: {
                    notEmpty: {
                        message: 'La materia debe tener un NRC.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'El NRC de una materia se representa por 4 dígitos.'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'El NRC de una materia se representa por 4 dígitos.'
                    }
                }
            },
            subjectCode:{
                validators: {
                    message: 'El código de una materia se representa por 3 letras en mayúscula.',
                    notEmpty: {
                        message: 'La materia debe tener un código.'
                    },
                    regexp: {
                        regexp: /^[A-Z]+$/,
                        message: 'El código de una materia se representa por 3 letras en mayúscula.'
                    },
                    stringLength: {
                        min: 3,
                        max: 3,
                        message: 'El código de una materia se representa por 3 letras en mayúscula.'
                    }
                }
            },
            subjectCourse:{
                message: 'El código de un curso se representa por 4 dígitos.',
                validators: {
                    notEmpty: {
                        message: 'La materia debe tener un código de curso.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'El código de un curso se representa por 4 dígitos.'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'El código de un curso se representa por 4 dígitos.'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            // $(e.target)    --> The field element
            // data.bv        --> The BootstrapValidator instance
            // data.field     --> The field name
            // data.element   --> The field element
            // data.validator --> The current validator name

            data.element
                .data('bv.messages')
                // Hide all the messages
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                // Show only message associated with current validator
                .filter('[data-bv-validator="' + data.validator + '"]').show();
    });

    $('#newUserForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitButtons: 'button[switch="nuevoUsuario"]',
        fields: {
            codigo:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'El código uninorte sólo puede contener números.'
                    }
                }
            },
            nombres:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/,
                        message: 'Los nombres sólo pueden contener letras y/o espacios en blanco.'
                    }
                }
            },
            apellidos:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/,
                        message: 'Los apellidos sólo pueden contener letras y/o espacios en blanco.'
                    }
                }
            },
            usuario:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'El nombre de usuario sólo puede contener caracteres alfabéticos.'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            // $(e.target)    --> The field element
            // data.bv        --> The BootstrapValidator instance
            // data.field     --> The field name
            // data.element   --> The field element
            // data.validator --> The current validator name

            data.element
                .data('bv.messages')
                // Hide all the messages
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                // Show only message associated with current validator
                .filter('[data-bv-validator="' + data.validator + '"]').show();
    });

    $('#editUserForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitButtons: 'button[switch="editarUsuario"]',
        fields: {
            codigo:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'El código uninorte sólo puede contener números.'
                    }
                }
            },
            nombres:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/,
                        message: 'Los nombres sólo pueden contener letras y/o espacios en blanco.'
                    }
                }
            },
            apellidos:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/,
                        message: 'Los apellidos sólo pueden contener letras y/o espacios en blanco.'
                    }
                }
            },
            usuario:{
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede quedar vacío.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'El nombre de usuario sólo puede contener caracteres alfabéticos.'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            // $(e.target)    --> The field element
            // data.bv        --> The BootstrapValidator instance
            // data.field     --> The field name
            // data.element   --> The field element
            // data.validator --> The current validator name

            data.element
                .data('bv.messages')
                // Hide all the messages
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                // Show only message associated with current validator
                .filter('[data-bv-validator="' + data.validator + '"]').show();
    });



});