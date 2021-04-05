<template>
    <div>
        <h3>Final Results</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3" v-for="(result, index) in results" v-bind:key="index">
                    <div class="card-body d-flex">

                        <img :src="result.user.imgUrl" alt="Profile Picture" style="height: 70px">
                        <div class="ml-3 flex-grow-1" style="line-height: 110%">
                            <strong>{{result.user.lname}}, {{result.user.fname}}</strong> <br>
                            {{result.user.school}} <br>
                            <div style="font-size: 1.5em; margin-top: 10px; font-weight: bold">
                                {{result.votes}} votes.
                            </div>
                        </div>

                        <div style="font-size: 2.0em; color: green" v-if="index < result.numOfWinners">
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data: function(){
        return {
            results: []
        }
    },
    methods: {
        getResults: function() {
            axios.get('/election/results')
                .then(response=>{
                    if(response.status==200){
                        this.results = response.data;
                    }
                })
        }
    },
    created() {
        this.getResults();
    }
}

</script>
