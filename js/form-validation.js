$(function() {
    $("form[name='add-news']").validate({
        rules: {
            title: {
                required: true,
                minlength: 5,
                maxlength: 30
            },
            short_content: {
                required: true,
                minlength: 10,
                maxlength: 100
                
            },
            content: {
                required: true
            },
            image: {
                required: true
            },
            category: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Potrebno je upisati naslov.",
                minlength: "Naslov vijesti mora imati minimalno 5 znakova.",
                maxlength: "Naslov vijesti može imati maksimalno 30 znakova."
            },
            short_content: {
                required: "Potrebno je upisati kratki sadržaj vijesti.",
                minlength: "Kratki sadržaj vijesti mora imati minimalno 10 znakova.",
                maxlength: "Kratki sadržaj vijesti može imati maksimalno 100 znakova."
            },
            content: {
                required: "Potrebno je upisati sadržaj vijesti."
            },
            image: {
                required: "Potrebno je učitati sliku."
            },
            category: {
                required: "Potrebno je odabrati kategoriju."
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    $("form[name='edit-news']").validate({
        rules: {
            title: {
                required: true,
                minlength: 5,
                maxlength: 30
            },
            short_content: {
                required: true,
                minlength: 10,
                maxlength: 100
                
            },
            content: {
                required: true
            },
            category: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Potrebno je upisati naslov.",
                minlength: "Naslov vijesti mora imati minimalno 5 znakova.",
                maxlength: "Naslov vijesti može imati maksimalno 30 znakova."
            },
            short_content: {
                required: "Potrebno je upisati kratki sadržaj vijesti.",
                minlength: "Kratki sadržaj vijesti mora imati minimalno 10 znakova.",
                maxlength: "Kratki sadržaj vijesti može imati maksimalno 100 znakova."
            },
            content: {
                required: "Potrebno je upisati sadržaj vijesti."
            },
            category: {
                required: "Potrebno je odabrati kategoriju."
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    $("form[name='login_form']").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 30
                
            },
        },
        messages: {
            username: {
                required: "Korisničko ime je obavezno.",
                minlength: "Minimalno 3 znaka.",
                maxlength: "Maximalno 30 znakova."
            },
            password: {
                required: "Lozinka je obavezna.",
                minlength: "Minimalno 3 znaka.",
                maxlength: "Maximalno 30 znakova."
            },
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    $("form[name='register_form']").validate({
        rules: {
            name: {
                required: true
            },
            surname: {
                required: true
            },
            username: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 30
                
            },
            repeat_password: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Ime je obavezno."
            },
            surname: {
                required: "Prezime je obavezno."
            },
            username: {
                required: "Korisničko ime je obavezno.",
                minlength: "Minimalno 3 znaka.",
                maxlength: "Maximalno 30 znakova."
            },
            password: {
                required: "Lozinka je obavezna.",
                minlength: "Minimalno 3 znaka.",
                maxlength: "Maximalno 30 znakova."
            },
            repeat_password: {
                required: "Potrebno je ponoviti lozinku."
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
});