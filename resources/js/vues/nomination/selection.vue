<template>
    <div>
        <h3>Candidate Selection</h3>
        <div class="row">
            <div class="col-md-6">
                <h4>Nominees</h4>
                <div class="user-box"
                        v-for="(nom, index) in nominees"
                        :key="index"
                        @click="makeCandidate(nom)">
                    <img :src="nom.imgUrl" alt="" class="user-pic">
                    <div class="user-info">
                        <strong>{{nom.lname}}, {{nom.fname}}</strong><br>
                        <i>{{nom.designation}}</i><br>
                        {{nom.school}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Candidates</h4>
                <div class="user-box"
                        v-for="(can, index) in candidates"
                        :key="index"
                        @click="removeCandidate(can)">
                    <img :src="can.imgUrl" alt="" class="user-pic">
                    <div class="user-info">
                        <strong>{{can.lname}}, {{can.fname}}</strong><br>
                        <i>{{can.designation}}</i><br>
                        {{can.school}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
    data: function() {
        return {
            nominees: [],
            candidates: []
        }
    },
    methods: {
        getNominees: function() {
            axios.get('/nominees')
            .then(response=>{
                if(response.status==200) {
                    this.nominees = response.data;
                }
            })
        },
        getCandidates: function() {
            axios.get('/get-candidates')
            .then(response=>{
                if(response.status=200) {
                    this.candidates = response.data;
                }
            })
        },
        makeCandidate: function(nominee) {
            axios.post('/create-candidate', {
                id:nominee.id
            }).then(response=>{
                if(response.status==201) {
                    this.getNominees();
                    this.getCandidates();
                    console.log(response.data);
                }
            })
        },
        removeCandidate: function(candidate) {
            axios.put('/candidate', {
                id:candidate.id,
            }).then(response=>{
                if(response.status==200) {
                    this.getCandidates();
                    this.getNominees();
                }
            })
        }
    },
    created() {
        this.getNominees();
        this.getCandidates();
    }
})
</script>

<style scoped>

.user-box {
    display: flex;
    padding: 10px;
    background-color: #e6e6e6;
    margin-bottom: 20px;
    justify-content: flex-start;
    align-items: center;
    cursor: pointer;
}

.user-box:hover {
    box-shadow: 0px 0px 5px 1px #444;
}

.user-pic {
    width: 110px;
    height: 110px;
    border-radius: 55px;
    margin-right: 10px;
}
.user-info {
    font-size: 1.2em;
    line-height: 98%;
}

</style>
