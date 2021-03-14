<template>
    <div>
        <div class="alert alert-info">
            We are now at the voting phase of our election.
            Please select a maximum of {{max}} candidates.
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>List of Candidates</h3>
                <div class="user-box"
                        v-for="(can, index) in candidates"
                        :key="index"
                        @click="addCandidate(can)">
                    <img :src="can.imgUrl" alt="" class="user-pic">
                    <div class="user-info">
                        <strong>{{can.lname}}, {{can.fname}}</strong><br>
                        <i>{{can.designation}}</i><br>
                        {{can.school}}
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</template>

<script>

export default ({
    data: function() {
        return {
            max: Number,
            candidates: [],
            votes: []
        }
    },
    methods: {
        getMax: function() {
            axios.get('/get-max')
            .then(response=>{
                if(response.status==200) {
                    this.max = response.data;
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
        addCandidate: function(candidate) {
            if(this.votes.length>this.max) {
                alert('You have reached the maximum number of votes.');
            }else {
                this.votes.push(candidate);
                this.candidates.remove(candidate);
            }
        }
    },
    created() {
        this.getMax();
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
