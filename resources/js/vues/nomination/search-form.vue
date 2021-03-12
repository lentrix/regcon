<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control"
                            v-model="searchkey"
                            @keyup.enter="submit"
                            placeholder="Search participants">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" @click="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="participants-list-container" v-if="participants.length>0">
                    <div class="participants-list-box" v-for="(prtcpnt, index) in participants" :key="index">
                        <img :src="prtcpnt.imgUrl" alt="pic" class="participant-list-img">

                        <div class="info">
                            <strong>{{prtcpnt.fname}} {{prtcpnt.lname}}</strong><br>
                            <i>{{prtcpnt.designation}}</i><br>
                            {{prtcpnt.school}}
                        </div>
                    </div>
                </div>
                <p v-if="participants.length==0" class="alert alert-info">
                    No items found.
                </p>
            </div>
        </div>
    </div>
</template>

<script>

export default({
    data: function() {
        return {
            searchkey: '',
            participants: []
        }
    },
    methods: {
        submit: function() {
            axios.get('/search-participants/' + this.searchkey,{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then( response => {
                if(response.status == 200) {
                    this.participants = response.data;
                }
            })
            .catch(error=>{
                console.log(error);
            })
        }
    }
})
</script>

