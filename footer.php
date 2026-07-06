<!-- FOOTER -->
<footer class="footer-pro">

<div class="container">

    <!-- RECHERCHE -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="fw-bold text-center">Rechercher sur MLI Tech</h5>

            <form action="recherche.php" method="GET"
      class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 mt-3">

    <input
        type="text"
        name="search"
        class="form-control"
        style="max-width:500px;"
        placeholder="Rechercher un produit ou service..."
        required>

    <button type="submit" class="btn btn-primary">
        🔍 Rechercher
    </button>

</form>
        </div>
    </div>

    <hr class="bg-light">

    <!-- CONTACT & RESEAUX -->
    <div class="row text-start text-white">

        <!-- CONTACT -->
        <div class="col-md-6 mb-3">
            <h5 class="fw-bold">Contactez-Nous</h5>

            <p>📞 61 43 20 02 / 90 48 15 85</p>
            <p>📧 mlitech00223@gmail.com</p>
            <p>📍 Bamako, Mali</p>
        </div>

        <!-- RESEAUX -->
        <div class="col-md-6 text-md-end">
            <h5 class="fw-bold">Suivez-nous</h5>

            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>

    </div>

    <hr class="bg-light">

    <!-- COPYRIGHT -->
    <div class="text-center">
        <p>© <?php echo date("Y"); ?> MLI Tech | Tous droits réservés</p>
    </div>

</div>

</footer>

<style>
.footer-pro{
    background: linear-gradient(135deg,#0d3b66,#1e5f9e);
    color:white;
    padding:40px 0;
}

.footer-pro h5{
    margin-bottom:15px;
}

.footer-pro p{
    margin:5px 0;
    font-size:15px;
}

.social-icons a{
    display:inline-block;
    margin:5px;
    width:40px;
    height:40px;
    line-height:40px;
    text-align:center;
    border-radius:50%;
    background:rgba(255,255,255,0.2);
    color:white;
    font-size:18px;
    transition:0.3s;
    text-decoration:none;
}

.social-icons a:hover{
    background:#0d6efd;
    transform:scale(1.1);
    color:white;
}

.footer-pro .form-control{
    border:none;
    border-radius:30px;
    padding:12px 20px;
}

.footer-pro .btn{
    border-radius:30px;
    padding:12px 25px;
    white-space:nowrap;
}

@media(max-width:768px){

    .footer-pro{
        text-align:center;
    }

    .text-md-end{
        text-align:center !important;
    }

    .footer-pro .btn{
        width:100%;
        max-width:500px;
    }

    .footer-pro .form-control{
        width:100%;
    }
}
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>