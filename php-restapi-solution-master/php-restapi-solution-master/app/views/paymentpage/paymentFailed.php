<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 vh-100 text-center d-flex justify-content-center align-items-center">
            <div class="card text-center">
                <div class="card-body h-100">
                    <i class="fa fa-times-circle fa-5x text-danger"></i>
                    <h4 class="card-title mt-3">Payment Failed</h4>
                    <p class="card-text"><?= $models['error']; ?></p>
                    <?php if ($models['error'] == 'Your payment has failed. Please check your payment details and try again.'){ ?>
                        <a href="<?= $models['paymentLink']; ?>" class="btn btn-primary">Try the same payment again</a>
                    <?php }else{ ?>
                        <a href="/paymentpage" class="btn btn-primary">Go Back to Payment Page</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>