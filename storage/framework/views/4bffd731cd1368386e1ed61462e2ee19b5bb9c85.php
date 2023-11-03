<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo e(config('app.name')); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset("assets/vendors/css/vendor.bundle.base.css")); ?>">
  <link rel="stylesheet" href="<?php echo e(asset("assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css")); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/js/select.dataTables.min.css")); ?>">
  <link rel="stylesheet" href="<?php echo e(asset("assets/vendors/select2/select2.min.css")); ?>">
  <link rel="stylesheet" href="<?php echo e(asset("assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css")); ?>">
  <link rel="stylesheet" href="<?php echo e(asset("assets/css/vertical-layout-light/style.css")); ?>">
  <link href='https://css.gg/css' rel='stylesheet'>
  <link rel="shortcut icon" href="<?php echo e(asset("assets/images/logo.png")); ?>" />
  <style>
      @media  all and (max-width:480px) {
        .btn { width: 100%; display:block; }
    } 
      label{
          font-weight: bold;
          text-transform: uppercase;
          font-size: 16px!important
      }
      input{
        font-weight: bold;
        font-size: 16px!important
      }
}
  </style>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
  <script src="<?php echo e(asset('assets/js/jquery-1.11.3.min.js')); ?>"></script>
  <script src="<?php echo e(asset("assets/vendors/js/vendor.bundle.base.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/vendors/select2/select2.min.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/js/select2.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/vendors/datatables.net/jquery.dataTables.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/js/dataTables.select.min.js")); ?>"></script>
  <script src="<?php echo e(asset("assets/js/template.js")); ?>"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable(
        {
            searching: true,
            ordering:  false,
            paging:   true,
            dom: 'Bfrtip',
            buttons: [
                  {
                      extend: 'excelHtml5',
                      text: '<i class="mdi mdi-file-excel"></i> Excel',
                      titleAttr: 'Export to Excel',
                      className: 'btn btn-secondary',
                      exportOptions: {
                          columns: ':not(:last-child)',
                      }
                  },
                  {
                      extend: 'pdfHtml5',
                      text: '<i class="mdi mdi-file-pdf"></i> PDF',
                      titleAttr: 'PDF',
                      className: 'btn btn-success',
                      exportOptions: {
                          columns: ':not(:last-child)',
                      }
                    },
                    {
                      extend: 'print',
                      text: '<i class="gg-printer"></i>',
                      className: 'btn btn-primary',
                      exportOptions: {
                          columns: ':not(:last-child)',
                      }
                    }
                ],
                language: {
            "emptyTable": "Aucune donnée disponible dans le tableau",
            "lengthMenu": "Afficher _MENU_ éléments",
            "loadingRecords": "Chargement...",
            "processing": "Traitement...",
            "zeroRecords": "Aucun élément correspondant trouvé",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "previous": "Précédent",
                "next": "Suiv"
            },
            "aria": {
                "sortAscending": ": activer pour trier la colonne par ordre croissant",
                "sortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "1": "1 ligne sélectionnée"
                },
                "cells": {
                    "1": "1 cellule sélectionnée",
                    "_": "%d cellules sélectionnées"
                },
                "columns": {
                    "1": "1 colonne sélectionnée",
                    "_": "%d colonnes sélectionnées"
                }
            },
            "autoFill": {
                "cancel": "Annuler",
                "fill": "Remplir toutes les cellules avec <i>%d<\/i>",
                "fillHorizontal": "Remplir les cellules horizontalement",
                "fillVertical": "Remplir les cellules verticalement"
            },
            "searchBuilder": {
                "conditions": {
                    "date": {
                        "after": "Après le",
                        "before": "Avant le",
                        "between": "Entre",
                        "empty": "Vide",
                        "equals": "Egal à",
                        "not": "Différent de",
                        "notBetween": "Pas entre",
                        "notEmpty": "Non vide"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vide",
                        "equals": "Egal à",
                        "gt": "Supérieur à",
                        "gte": "Supérieur ou égal à",
                        "lt": "Inférieur à",
                        "lte": "Inférieur ou égal à",
                        "not": "Différent de",
                        "notBetween": "Pas entre",
                        "notEmpty": "Non vide"
                    },
                    "string": {
                        "contains": "Contient",
                        "empty": "Vide",
                        "endsWith": "Se termine par",
                        "equals": "Egal à",
                        "not": "Différent de",
                        "notEmpty": "Non vide",
                        "startsWith": "Commence par"
                    },
                    "array": {
                        "equals": "Egal à",
                        "empty": "Vide",
                        "contains": "Contient",
                        "not": "Différent de",
                        "notEmpty": "Non vide",
                        "without": "Sans"
                    }
                },
                "add": "Ajouter une condition",
                "button": {
                    "0": "Recherche avancée",
                    "_": "Recherche avancée (%d)"
                },
                "clearAll": "Effacer tout",
                "condition": "Condition",
                "data": "Donnée",
                "deleteTitle": "Supprimer la règle de filtrage",
                "logicAnd": "Et",
                "logicOr": "Ou",
                "title": {
                    "0": "Recherche avancée",
                    "_": "Recherche avancée (%d)"
                },
                "value": "Valeur"
            },
            "searchPanes": {
                "clearMessage": "Effacer tout",
                "count": "{total}",
                "title": "Filtres actifs - %d",
                "collapse": {
                    "0": "Volet de recherche",
                    "_": "Volet de recherche (%d)"
                },
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Pas de volet de recherche",
                "loadMessage": "Chargement du volet de recherche..."
            },
            "buttons": {
                "collection": "Collection",
                "colvis": "Visibilité colonnes",
                "colvisRestore": "Rétablir visibilité",
                "copy": "Copier",
                "copySuccess": {
                    "1": "1 ligne copiée dans le presse-papier",
                    "_": "%ds lignes copiées dans le presse-papier"
                },
                "copyTitle": "Copier dans le presse-papier",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Afficher toutes les lignes",
                    "_": "Afficher %d lignes"
                },
                "pdf": "PDF",
                "print": "Imprimer",
                "copyKeys": "Appuyez sur ctrl ou u2318 + C pour copier les données du tableau dans votre presse-papier."
            },
            "decimal": ",",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
            "infoEmpty": "Affichage de 0 à 0 sur 0 éléments",
            "infoThousands": ".",
            "search": "Rechercher:",
            "thousands": ".",
            "infoFiltered": "(filtrés depuis un total de _MAX_ éléments)",
            "datetime": {
                "previous": "Précédent",
                "next": "Suivant",
                "hours": "Heures",
                "minutes": "Minutes",
                "seconds": "Secondes",
                "unknown": "-",
                "amPm": [
                    "am",
                    "pm"
                ],
                "months": {
                    "0": "Janvier",
                    "2": "Mars",
                    "3": "Avril",
                    "4": "Mai",
                    "5": "Juin",
                    "6": "Juillet",
                    "7": "Aout",
                    "8": "Septembre",
                    "9": "Octobre",
                    "10": "Novembre",
                    "1": "Février",
                    "11": "Décembre"
                },
                "weekdays": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ]
            },
            "editor": {
                "close": "Fermer",
                "create": {
                    "title": "Créer une nouvelle entrée",
                    "submit": "Envoyer",
                    "button": "Nouveau"
                },
                "edit": {
                    "button": "Editer",
                    "title": "Editer Entrée",
                    "submit": "Modifier"
                },
                "remove": {
                    "button": "Supprimer",
                    "title": "Supprimer",
                    "submit": "Supprimer",
                    "confirm": {
                        "_": "Êtes-vous sûr de vouloir supprimer %d lignes ?",
                        "1": "Êtes-vous sûr de vouloir supprimer 1 ligne ?"
                    }
                },
                "error": {
                    "system": "Une erreur système s'est produite"
                },
                "multi": {
                    "noMulti": "Ce champ peut être édité individuellement, mais ne fait pas partie d'un groupe. ",
                    "info": "Les éléments sélectionnés contiennent différentes valeurs pour ce champ. Pour  modifier et ",
                    "title": "Valeurs multiples",
                    "restore": "Rétablir modification"
                }
            }
        }
        }
    );
   /*  $(".buttons-html5").addClass("btn");
    $(".buttons-html5").addClass("btn-success"); */
} );

</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/index.blade.php ENDPATH**/ ?>