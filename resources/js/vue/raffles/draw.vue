<template>
    <div>
        <div class="row">
            <div class="col-md-7">
                <h1>Raffle Manager</h1>
            </div>
            <div class="col-md-5">
                <nav aria-label="breadcrumb" style="float: right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('/admin') ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?= url('/admin/raffles') ?>">Raffles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Raffle Draw</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h3>Raffle Draw</h3>
    </div>
</template>

<script>

export default {
    data: function() {
        return {
            items: [],
            draws: []
        }
    },
    method: {
        getItems: function() {
            axios.get('/admin/raffles/items')
                .then(response=>{
                    if(response.status = 200) {
                        this.items = response.data
                    }
                })
        },
        getDraws: function() {
            axios.get('/admin/raffles/draws')
                .then(response=>{
                    if(response.status==200) {
                        this.draws = response.data
                    }
                })
        }
    },
    created() {
        this.getItems();
        this.getDraws();
    }
}
</script>
