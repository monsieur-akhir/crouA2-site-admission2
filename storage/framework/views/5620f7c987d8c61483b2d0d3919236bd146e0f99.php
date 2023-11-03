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
        <p style="position: absolute; top:140px; left:260px; with:100px; text-align:center">ANNEE UNIVERSITAIRE <br> 2023-2024</p>
        <h2 style="position: absolute; top:220px; left:320px"><?php echo e($data->age); ?> ans</h2>
        <h4 style="position: absolute; top:65px; left:615px">(PHOTO)</h4>
        <div style="float: left; width:250px">
            <div>
                <p style="text-align: center; font-size:12px">REPUBLIQUE DE COTE D’IVOIRE
                    <br> ---------------- <br>
                    MINISTERE DE L’ENSEIGNEMENT SUPERIEUR ET DE LA RECHERCHE SCIENTIFIQUE
                    <br> ---------------- <br>
                    <img src="http://5.196.8.55/assets/images/logo.png" style="width: 90px!important;display:block; margin-left: auto;margin-right: auto;" width="90px" class="mt-5" alt=""><br>
                    
                    CENTRE REGIONAL DES ŒUVRES UNIVERSITAIRES ABIDJAN 2 (CROU-A2)
                </p>
            </div>
        </div>
        <div style="float: right">
            <div class="mr-2">
                <img src="<?php echo e("http://5.196.8.55/".$data->image); ?>" alt="" style="width:130px;height:200px; margin-top:10px" srcset="">
            </div>
        </div>
    </section>
    <img src="http://5.196.8.55/assets/images/logo.png" style="z-index:99;display:block; position:absolute; top:350px;left:150px;opacity:0.2" width="400px" class="mt-5" alt=""><br>
    <section style="margin-top:230px;">
        <div style="background-color: rgb(2, 2, 128);">
            <h4 style="color:white;padding:10px;text-align:center;font-weight:bold">FORMULAIRE DE DEMANDE DE READMISSION EN RESIDENCE UNIVERSITAIRE </h4>
        </div>
        <h4 style="color:rgb(2, 2, 128); text-decoration:underline;font-size:14px">I - IDENTIFICATION DE L' ETUDIANT</h4>
        <div style="float: left;width:50%; font-size:14px">
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
        <div style="float: left; margin-left:40px;width:50%;font-size:14px">
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
    <section style="margin-top:140px;">
        <div style="font-size:14px">
            <h4 style="color:rgb(2, 2, 128); text-decoration:underline">II - CURSUS UNIVERSITAIRE</h4>
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
            <h4 style="color:rgb(2, 2, 128); text-decoration:underline">III- SITUATION ANTERIEURE DU RESIDENT</h4>
            <div style="float: left;width:50%; font-size:14px">
                <p>CITE UNIVERSITAIRE : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('cites')->where('id',$data->cite_id)->first()->libelle)); ?></span></p>  
                <p>PALIER : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('paliers')->where('id',$data->palier_id)->first()->libelle)); ?></span></p>  
                
            </div>
            <div style="float: left; margin-left:40px;width:50%;font-size:14px">
                <p>BÂTIMENT : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('batiments')->where('id',$data->batiment_id)->first()->libelle)); ?></span></p>  
                <p>NUMERO DE CHAMBRE : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('chambres')->where('id',$data->chambre_id)->first()->libelle)); ?></span></p>  
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
                        photo d’identité récente
                    </li>
                    <li>
                        Reçus de payement de loyer
                    </li>
            </ul>
            <p> NB : Déposer l’ensemble des pièces demandées dans un intercalaire plastique au niveau de sa cité universitaire <br>
                Je certifie sur l’honneur de la sincérité des renseignements ci-dessus <br>
                Signature de l’étudiant
            </div>
        </div>
    </section>
    <div style="position: absolute;
    bottom: 0; width:100%">
    <hr style="border: 2px solid rgb(2, 2, 128); width:100%">
    <div>
        <p style="text-align: center; font-size:8px">Siège social : Université Nangui-Abrogoua -Villa N° 6, face Scolarité</p>
        <p style="text-align: center;color:rgb(2, 2, 128);font-size:8px">Email: crouabidjan2@gmail.com / Facebook: Crou Abidjan 2</p>
        <p style="text-align: center;font-size:8px">Adresse postale : 01 BPV 8 Abidjan 01</p>
        <p style="text-align: center;font-size:8px">Tel. : (+225) 01.52.47.78.75</p>
    </div>
    <div>
        <div style="float: left;font-size:8px">Date d'inscription: <?php echo e($data->created_at); ?></div>
        <div style="float: right;font-size:8px">1/1</div>
    </div>
    </div>
    
</body>
</html><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/dossiers/fiche-readmission.blade.php ENDPATH**/ ?>