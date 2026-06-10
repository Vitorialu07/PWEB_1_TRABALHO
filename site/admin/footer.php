            </div> 
        </div> 
    </div>
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<?php if(isset($isLoggedIn) && $isLoggedIn): ?>
<script>
    // Adicionar classe active ao menu baseado na URL atual
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        if(link.href === window.location.href) {
            link.classList.add('active');
        }
    });
    
    
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
<?php endif; ?>

</body>
</html>