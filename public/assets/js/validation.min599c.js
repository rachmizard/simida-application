/*!
 * Remark (http://getbootstrapadmin.com/remark)
 * Copyright 2017 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */

!function(global, factory) {
    if("function"==typeof define&&define.amd)define("/forms/validation", ["jquery", "Site"], factory);
    else if("undefined"!=typeof exports)factory(require("jquery"), require("Site"));
    else {
        var mod= {
            exports: {}
        }
        ;
        factory(global.jQuery, global.Site),
        global.formsValidation=mod.exports
    }
}

(this, function(_jquery, _Site) {
    "use strict";
    var _jquery2=babelHelpers.interopRequireDefault(_jquery), Site=babelHelpers.interopRequireWildcard(_Site);
    (0, _jquery2.default)(document).ready(function($) {
        Site.run()
    }
    ), (0, _jquery2.default)("#formLogin").formValidation( {
        framework:"bootstrap4", button: {
            selector: "#validateButton1", disabled: "disabled"
        }
        , icon:null, fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: "The username is required"
                    }
                    , stringLength: {
                        min: 6, max: 30
                    }
                    , regexp: {
                        regexp: /^[a-zA-Z0-9]+$/
                    }
                }
            }
            , email: {
                validators: {
                    notEmpty: {
                        message: "Mohon masukan email"
                    }
                    , emailAddress: {
                        message: "Alamat Email Tidak Valid"
                    }
                }
            }
            , password: {
                validators: {
                    notEmpty: {
                        message: "Mohon masukan password"
                    }
                    , stringLength: {
                        min: 5
                    }
                }
            }
            , birthday: {
                validators: {
                    notEmpty: {
                        message: "The birthday is required"
                    }
                    , date: {
                        format: "YYYY/MM/DD"
                    }
                }
            }
            , github: {
                validators: {
                    url: {
                        message: "The url is not valid"
                    }
                }
            }
            , skills: {
                validators: {
                    notEmpty: {
                        message: "The skills is required"
                    }
                    , stringLength: {
                        max: 300
                    }
                }
            }
            , porto_is: {
                validators: {
                    notEmpty: {
                        message: "Please specify at least one"
                    }
                }
            }
            , "for[]": {
                validators: {
                    notEmpty: {
                        message: "Please specify at least one"
                    }
                }
            }
            , company: {
                validators: {
                    notEmpty: {
                        message: "Please company"
                    }
                }
            }
            , browsers: {
                validators: {
                    notEmpty: {
                        message: "Please specify at least one browser you use daily for development"
                    }
                }
            }
        }
        , err: {
            clazz: "invalid-feedback"
        }
        , control: {
            valid: "is-valid", invalid: "is-invalid"
        }
        , row: {
            invalid: "has-danger"
        }
    }
    ), (0, _jquery2.default)("#exampleConstraintsForm, #exampleConstraintsFormTypes").formValidation( {
        framework:"bootstrap4", icon:null, fields: {
            type_email: {
                validators: {
                    emailAddress: {
                        message: "The email address is not valid"
                    }
                }
            }
            , type_url: {
                validators: {
                    url: {
                        message: "The url is not valid"
                    }
                }
            }
            , type_digits: {
                validators: {
                    digits: {
                        message: "The value is not digits"
                    }
                }
            }
            , type_numberic: {
                validators: {
                    integer: {
                        message: "The value is not an number"
                    }
                }
            }
            , type_phone: {
                validators: {
                    phone: {
                        message: "The value is not an phone(US)"
                    }
                }
            }
            , type_credit_card: {
                validators: {
                    creditCard: {
                        message: "The credit card number is not valid"
                    }
                }
            }
            , type_date: {
                validators: {
                    date: {
                        format: "YYYY/MM/DD"
                    }
                }
            }
            , type_color: {
                validators: {
                    color: {
                        type: ["hex", "hsl", "hsla", "keyword", "rgb", "rgba"], message: "The value is not valid color"
                    }
                }
            }
            , type_ip: {
                validators: {
                    ip: {
                        ipv4: !0, ipv6: !0, message: "The value is not valid ip(v4 or v6)"
                    }
                }
            }
        }
        , err: {
            clazz: "invalid-feedback"
        }
        , control: {
            valid: "is-valid", invalid: "is-invalid"
        }
        , row: {
            invalid: "has-danger"
        }
    }
    ), (0, _jquery2.default)("#exampleStandardForm").formValidation( {
        framework:"bootstrap4", button: {
            selector: "#validateButton2", disabled: "disabled"
        }
        , icon:null, fields: {
            standard_fullName: {
                validators: {
                    notEmpty: {
                        message: "The full name is required and cannot be empty"
                    }
                }
            }
            , standard_email: {
                validators: {
                    notEmpty: {
                        message: "The email address is required and cannot be empty"
                    }
                    , emailAddress: {
                        message: "The email address is not valid"
                    }
                }
            }
            , standard_content: {
                validators: {
                    notEmpty: {
                        message: "The content is required and cannot be empty"
                    }
                    , stringLength: {
                        max: 500, message: "The content must be less than 500 characters long"
                    }
                }
            }
        }
        , err: {
            clazz: "invalid-feedback"
        }
        , control: {
            valid: "is-valid", invalid: "is-invalid"
        }
        , row: {
            invalid: "has-danger"
        }
    }
    ), (0, _jquery2.default)(".summary-errors").hide(), (0, _jquery2.default)("#exampleSummaryForm").formValidation( {
        framework:"bootstrap4", button: {
            selector: "#validateButton3", disabled: "disabled"
        }
        , icon:null, fields: {
            summary_fullName: {
                validators: {
                    notEmpty: {
                        message: "The full name is required and cannot be empty"
                    }
                }
            }
            , summary_email: {
                validators: {
                    notEmpty: {
                        message: "The email address is required and cannot be empty"
                    }
                    , emailAddress: {
                        message: "The email address is not valid"
                    }
                }
            }
            , summary_content: {
                validators: {
                    notEmpty: {
                        message: "The content is required and cannot be empty"
                    }
                    , stringLength: {
                        max: 500, message: "The content must be less than 500 characters long"
                    }
                }
            }
        }
        , err: {
            clazz: "invalid-feedback"
        }
        , control: {
            valid: "is-valid", invalid: "is-invalid"
        }
        , row: {
            invalid: "has-danger"
        }
    }
    ).on("success.form.fv", function(e) {
        (0, _jquery2.default)(".summary-errors").html("")
    }
    ).on("err.field.fv", function(e, data) {
        (0, _jquery2.default)(".summary-errors").show();
        var messages=data.fv.getMessages(data.element);
        (0, _jquery2.default)(".summary-errors").find('li[data-field="'+data.field+'"]').remove();
        for(var i in messages)(0, _jquery2.default)("<li/>").attr("data-field", data.field).wrapInner((0, _jquery2.default)("<a/>").attr("href", "javascript: void(0);").html(messages[i]).on("click", function(e) {
            data.element.focus()
        }
        )).appendTo(".summary-errors > ul");
        data.element.data("fv.messages").find('.invalid-feedback[data-fv-for="'+data.field+'"]').hide()
    }
    ).on("success.field.fv", function(e, data) {
        (0, _jquery2.default)(".summary-errors > ul").find('li[data-field="'+data.field+'"]').remove(), (0, _jquery2.default)("#exampleSummaryForm").data("formValidation").isValid()&&(0, _jquery2.default)(".summary-errors").hide()
    }
    )
}

);