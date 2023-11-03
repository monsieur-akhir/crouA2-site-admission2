<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p,
        h1 {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
    <section>
        <p style="position: absolute; top:140px; left:260px; with:100px; text-align:center">ANNEE UNIVERSITAIRE <br> 2021-2022</p>
        <h2 style="position: absolute; top:180px; left:320px"><?php echo e($data->age); ?> ans</h2>
        <div style="float: left; width:250px">
            <div>
                <p style="text-align: center; font-size:12px">REPUBLIQUE DE COTE D’IVOIRE
                    <br> ---------------- <br>
                    MINISTERE DE L’ENSEIGNEMENT SUPERIEUR ET DE LA RECHERCHE SCIENTIFIQUE
                    <br> ---------------- <br>
                    <img src="<?php echo e(url('/assets/images/logo.png')); ?>" style="max-width: 90px;display:block; margin-left: auto;margin-right: auto;" width="90px" class="mt-5" alt=""><br>
                    
                    CENTRE REGIONAL DES ŒUVRES UNIVERSITAIRES ABIDJAN 2 (CROU-A2)
                    
                </p>
            </div>
        </div>
        <div style="float: right">
            <div class="mr-2">
                <img src="<?php echo e($data->image); ?>" alt="" style="width:130px;height:200px; margin-top:10px" srcset="">
            </div>
        </div>
       
    </section>
    <img src="<?php echo e(url('/assets/images/logo.png')); ?>" style="max-width: 400px;z-index:99;display:block; position:absolute; top:350px;left:150px;opacity:0.2" width="400px" class="mt-5" alt=""><br>
    <section style="margin-top:230px;">
        <div style="background-color: orange;">
            <h4 style="color:white;padding:10px;text-align:center;font-weight:bold">FORMULAIRE DE DEMANDE D’ADMISSION EN RESIDENCE UNIVERSITAIRE </h4>
        </div>
        <h4 style="color:orange; text-decoration:underline">I - IDENTIFICATION DE L' ETUDIANT</h4>
        <div style="float: left;width:50%">
            <p>IDENTIFIANT : <span style="font-weight:bold;color:red"><?php echo e(strtoupper($data->matricule_crou)); ?></span></p>  
            <p>N° CARTE D'ETUDIANT : <span style="font-weight:bold"><?php echo e(strtoupper($data->num_carte)); ?></span></p>  
            <p>NOM : <span style="font-weight:bold"><?php echo e(strtoupper($data->nom_etudiant)); ?></span></p>  
            <p>NÉ(E) LE : <span style="font-weight:bold"><?php echo e(strtoupper(Carbon\Carbon::parse($data->date_naissance_etudiant)->format('d/m/Y'))); ?></span></p>  
            <p>SEXE : <span style="font-weight:bold"><?php echo e(strtoupper($data->genre)); ?></span></p>  
            <p>CONTACT : <span style="font-weight:bold"><?php echo e(strtoupper($data->contact_etudiant)); ?></span></p>   
            <p>HANDICAPE : <span style="font-weight:bold"><?php echo e(strtoupper($data->handicap_etudiant)); ?></span></p>  
            <?php if($data->handicap_etudiant == "Oui"): ?><p>PRECISION DE L'HANDICAP :  <span style="font-weight:bold"><?php echo e(strtoupper($data->precision_handicap)); ?></span></p> <?php endif; ?>   
            <p>NOM DU PARENT : <span style="font-weight:bold"><?php echo e(strtoupper($data->nom_tuteur)); ?></span></p>  
        </div>
        <div style="float: left; margin-left:40px;width:50%">
           <br><br>
            <p>PRENOMS : <span style="font-weight:bold"><?php echo e(strtoupper($data->prenoms_etudiant)); ?></span></p>  
            <p>À : <span style="font-weight:bold"><?php echo e(strtoupper($data->lieu_naissance_etudiant)); ?></span></p>  
            <p>NATIONALITE : <span style="font-weight:bold"><?php echo e(strtoupper($data->nationnalite)); ?></span></p>  
            <p>EMAIL : <span style="font-weight:bold"><?php echo e($data->email_etudiant); ?></span></p>  
           <br>
           <?php if($data->handicap_etudiant == "Oui"): ?><br> <?php endif; ?>   
            <p>CONTACT DU PARENT: <span style="font-weight:bold"><?php echo e(strtoupper($data->contact_tuteur)); ?></span></p>  
        </div>
    </section>
    <section style="margin-top:170px;">
        <div>
            <h4 style="color:orange; text-decoration:underline">II - CURSUS UNIVERSITAIRE</h4>
            <p>UNIVERSITE/STRUCTURE/ECOLE : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('universites')->where('id',$data->ufr_etudiant)->first()->libelle)); ?></span></p>  
            <?php if($data->ecole_etudiant != null): ?>
                <p> NOM ECOLE : <span style="font-weight:bold"><?php echo e(strtoupper($data->ecole_etudiant)); ?></span></p> 
            <?php else: ?>
                <?php if($data->ufr_etudiant != 1): ?>
                    <p> UFR/DEPARTEMENT : <span style="font-weight:bold"><?php echo e(strtoupper($data->departement_etudiant)); ?></span></p>  
                <?php else: ?>
                    <p> UFR/DEPARTEMENT : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('departements')->where('id',$data->departement_etudiant)->first()->libelle)); ?></span></p>  
                <?php endif; ?>
            <?php endif; ?>
            <?php
                $filiere = DB::table('filieres')->where('id',$data->filiere)->first();
            ?>
            <?php if($filiere): ?>
              <p>FILIERE : <span style="font-weight:bold"><?php echo e(strtoupper($filiere->libelle)); ?></span></p>  
            <?php else: ?>
              <p>FILIERE : <span style="font-weight:bold"><?php echo e(strtoupper($data->filiere)); ?></span></p>  
            <?php endif; ?>
            <p>NIVEAU ACTUEL : <span style="font-weight:bold"><?php echo e(strtoupper($data->niveau_actuel_etudiant)); ?></span></p>
            <p>NIVEAU PRECEDENT : <span style="font-weight:bold"><?php echo e(strtoupper($data->niveau_precedent_etudiant)); ?></span></p>  
            <p>DECISION DE FIN D'ANNEE : <span style="font-weight:bold"><?php echo e(strtoupper($data->decision_final_etudiant)); ?></span></p>
            <?php if($data->is_bachelier == 'Oui'): ?>
                <p>NOMBRE DE POINT AU BAC : <span style="font-weight:bold"><?php echo e($data->point_bac); ?></span></p>
                <p>SERIE  : <span style="font-weight:bold"><?php echo e(strtoupper($data->serie_bac)); ?></span></p>  
                <p>MENTION : <span style="font-weight:bold"><?php echo e(strtoupper($data->mention_bac)); ?></span></p>
            <?php endif; ?>
        </div>
        <div style="font-size:12px">
            <p><b>Pièces à joindre :</b></p>
            <ul>
                <li>
                    Photocopie de la carte d’étudiant ou du certificat de scolarité
                </li>
                <li>
                    Photocopie du reçu d’inscription
                </li>
                <li>
                    Photocopie du relevé de notes ou de l’attestation de réussite
                </li>
                <li>
                    Photocopie de l’attestation de réussite au BAC pour les L1
                </li>
                <li>
                    Fiche d’engagement parental (à légaliser à la mairie) + photocopie CNI du parent ou du tuteur 
                </li>
                <li> 
                    Photocopie de la Carte Nationale d’Identité et 01 photo d’identité de même tirage
                </li>
        </ul>
        <p> NB : Déposer l’ensemble des pièces demandées dans une chemise à rabat (Bleu : Garçon, Orange : Fille) dans les différents ateliers ouverts à la Sous-direction de l’Accueil et des Logements (S/DAL).
            Je certifie sur l’honneur de la sincérité des renseignements ci-dessus</p>
            Signature de l’étudiant
        </div>
    </section>
    <div style="position: absolute;
    bottom: 0; width:100%">
    <hr style="border: 2px solid orange; width:100%">
    <div>
        <p style="text-align: center; font-size:8px">Siège social : Université Nangui-Abrogoua -Villa N° 6, face Scolarité</p>
        <p style="text-align: center;color:orange;font-size:8px">Email: crouabidjan2@gmail.com / Facebook: Crou Abidjan 2</p>
        <p style="text-align: center;font-size:8px">Adresse postale : 01 BPV 8 Abidjan 01</p>
        <p style="text-align: center;font-size:8px">Tel. : (+225) 01.52.47.78.75</p>
    </div>
    <div>
        <div style="float: left;font-size:8px">Date d'inscription: <?php echo e($data->created_at); ?></div>
        <div style="float: right;font-size:8px">1/1</div>
    </div>
    </div>
    
</body>
</html><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/dossiers/fiche.blade.php ENDPATH**/ ?>