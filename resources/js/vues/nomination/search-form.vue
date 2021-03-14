<template>
    <div>
        <div v-if="notNominated">
            <nominate v-bind:nominee="nominee" v-on:nominated="hasNominated($event)"></nominate>
            <div style="margin-bottom: 15px;">Search for a participant to nominate. You can only nominate one participant.</div>
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
                        <div class="participants-list-box"
                                v-for="(prtcpnt, index) in participants" :key="index"
                                @click="showNominationForm(prtcpnt)">
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
        <div v-if="nominated">
            <div class="alert alert-success">
                <h3>Congratulations!!!</h3>
                <p>You have successfully nominated</p>
                <div class="nominee-box">
                    <img :src="nominatedUser.imgUrl" alt="" class="nominee-pic">
                    <div class="nominee-info">
                        <strong>{{nominatedUser.lname}}, {{nominatedUser.fname}}</strong><br>
                        <i>{{nominatedUser.designation}}</i><br>
                        {{nominatedUser.school}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Nominate from './nominate'

export default({
    components: {Nominate},

    data: function() {
        return {
            searchkey: '',
            participants: [],
            nominee: null,
            nominated: false,
            nominatedUser: null,
            notNominated: false
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
        },
        showNominationForm: function(participant) {
            $("#nominateModal").modal('show');
            this.nominee = participant;
        },
        hasNominated: function(nominee) {
            this.nominated = true;
            this.notNominated=false;
            this.nominatedUser = nominee;
        },
        checkNominated: function() {
            axios.get('/check-nominated')
            .then(response=>{
                if(response.status==200) {
                    if(response.data) {
                        this.nominated=true;
                        this.nominatedUser=response.data;
                    }else{
                        this.notNominated=true;
                    }
                }
            })
        }
    },
    created() {
        this.checkNominated();
    }
})
</script>

<style scoped>
.nominee-box {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    border-radius: 20px;
    background-color:rgb(245, 245, 245);
    padding: 20px;
}
.nominee-info {
    font-size: 1.6em;
    line-height: 98%;
}
.nominee-pic {
    width: 200px;
    height: 200px;
    border-radius: 100px;
    margin-right: 20px;
}
</style>
