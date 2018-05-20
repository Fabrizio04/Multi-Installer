$(document).ready(function()
{
$("#formsetup").validate({
    rules:{
        'percorsoWeb':{
            required: true
            },
        'percorsoRep':{
            required: true
            },
        'lettera':{
            required: true
            },
        'host':{
            required: true
            },
         'usDB':{
            required: true
          },
		  'database':{
            required: true
		  },
		  'motore':{
            required: true
		  }
    },
    messages:{
        'percorsoWeb':{
            required: "Campo Obbligatorio!"
            },
        'percorsoRep':{
            required: "Campo Obbligatorio!"
            },
        'lettera':{
            required: "Campo Obbligatorio!"
            },
        'host':{
            required: "Campo Obbligatorio!"
            },
         'usDB':{
            required: "Campo Obbligatorio!"
            },
		 'database':{
            required: "Campo Obbligatorio!"
         },
		  'motore':{
            required: "Campo Obbligatorio!"
         }

    }
});
});

$(document).ready(function()
{
$("#costruisci").validate({
    rules:{
        'nome':{
            required: true
            },
        'stringa':{
            required: true
            },
        'controllo':{
            required: true
            }
    },
    messages:{
        'nome':{
            required: "Campo Obbligatorio!"
            },
        'stringa':{
            required: "Campo Obbligatorio!"
            },
        'controllo':{
            required: "Campo Obbligatorio!"
            }
    }
});
});