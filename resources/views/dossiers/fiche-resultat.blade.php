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
    <div style="float: left; width:250px">
        <div>
            <p style="text-align: center; font-size:12px">
                MINISTERE DE L’ENSEIGNEMENT SUPERIEUR ET DE LA RECHERCHE SCIENTIFIQUE
                <br> ---------------- <br>
                CENTRE REGIONAL DES ŒUVRES UNIVERSITAIRES ABIDJAN 2 (CROU-A2)
                <img src="http://5.196.8.55/assets/images/logo.png" style="max-width: 90px;display:block; margin-left: auto;margin-right: auto;" width="90px" class="mt-5" alt=""><br>
                SERVICE LOGEMENT
                {{-- <br> ---------------- <br>
                Sous-Direction de l’Accueil et des Logements (S/DAL) --}}
            </p>
        </div>
    </div>
    <div style="float: right; width:250px">
        <div>
            <p style="text-align: center; font-size:12px">REPUBLIQUE DE COTE D’IVOIRE<br>
                Union-Discipline-Travail
                <br> ---------------- <br>
                <img src="http://5.196.8.55/assets2/img/amoiri.png" style="max-width: 90px;display:block; margin-left: auto;margin-right: auto;" width="90px" class="mt-5" alt=""><br>
                {{-- <br> ---------------- <br>
                Sous-Direction de l’Accueil et des Logements (S/DAL) --}}
            </p>
        </div>
    </div>

</section>
<img src="http://5.196.8.55/assets/images/logo.png" style="max-width: 400px;z-index:99;display:block; position:absolute; top:350px;left:150px;opacity:0.2" width="400px" class="mt-5" alt=""><br>
<section style="margin-top:200px;">
    <div>
        <h4 style="padding:10px;text-align:center;font-weight:bold ; border: 2px solid black ;">RESULTAT DES ADMISSIONS EN RESIDENCE ABOBO 1 </h4>
    </div>
            <br>
            <br>
        <p style="font-size: 20px">Félicitations, Monsieur/Madame <span style="font-weight:bold;">{{strtoupper($data->nom_etudiant)}} {{strtoupper($data->prenoms_etudiant)}}</span> vous êtes admis(e) en Résidence Universitaire.</p><br><br>
        <p style="font-size: 20px ">Veuillez-vous rendre à l'Administration du CROU Abidjan 2 muni de ce
            document sise à l'Université Nangui Abrogoua -Villa N° 6, face Scolarité pour les formalités d'usage.
        </p>
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
        <div style="float: left;font-size:8px">Date d'impression:
            <?php $dt = new \DateTime();
echo $dt->format('d/m/Y H:i:s');?></div>
        <div style="float: right;font-size:8px">1/1</div>
    </div>
</div>

</body>
</html>