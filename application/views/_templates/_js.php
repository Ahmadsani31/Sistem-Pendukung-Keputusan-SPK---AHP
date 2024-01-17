<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="<?= base_url('assets'); ?>/js/scripts.js"></script>
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
<script type="text/javascript">
    <?php if ($this->session->flashdata('success')) { ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } else if ($this->session->flashdata('error')) {  ?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } else if ($this->session->flashdata('warning')) {  ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php } else if ($this->session->flashdata('info')) {  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
    $(document).ready(function() {
        $("nav a")
            .click(function(e) {
                var link = $(this);
                var item = link.parent("a");

                if (item.hasClass("active")) {
                    item.removeClass("active").children("a").removeClass("active");
                } else {
                    item.addClass("active").children("a").addClass("active");
                }

                if (item.children("ul").length > 0) {
                    var href = link.attr("href");
                    link.attr("href", "#");
                    setTimeout(function() {
                        link.attr("href", href);
                    }, 300);
                    e.preventDefault();
                }
            })

            .each(function() {
                var link = $(this);

                if (link.get(0).href === location.href) {
                    link.addClass("active").parents("li").addClass("active");
                    link.addClass("active").parents(".collapse").addClass("show");
                    return false;
                }
            });
    });
</script>