<template>
    <div>
        <div v-if="!voted">
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
                            @click="addCandidate(can, index)">
                        <img :src="can.imgUrl" alt="" class="user-pic">
                        <div class="user-info">
                            <strong>{{can.lname}}, {{can.fname}}</strong><br>
                            <i>{{can.designation}}</i><br>
                            {{can.school}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>You are voting for...</h3>
                    <div class="user-box"
                            v-for="(vote, index) in votes"
                            :key="index"
                            @click="removeVote(vote, index)">
                        <img :src="vote.imgUrl" alt="" class="user-pic">
                        <div class="user-info">
                            <strong>{{vote.lname}}, {{vote.fname}}</strong><br>
                            <i>{{vote.designation}}</i><br>
                            {{vote.school}}
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg" @click="submitVote()">
                        <i class="fa fa-check"></i>
                        Submit Vote
                    </button>
                </div>
            </div>
        </div>
    <div v-if="voted">
            <h1>You have voted the following...</h1>
            <div class="user-box"
                    v-for="(vc, index) in votedCandidates"
                    :key="index">
                <img :src="vc.imgUrl" alt="" class="user-pic">
                <div class="user-info">
                    <strong>{{vc.lname}}, {{vc.fname}}</strong><br>
                    <i>{{vc.designation}}</i><br>
                    {{vc.school}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
    data: function() {
        return {
            max: Number,
            candidates: [],
            votes: [],
            voted: false,
            votedCandidates: []
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
        addCandidate: function(candidate, index) {
            if(this.votes.length>=this.max) {
                alert('You have reached the maximum number of votes.');
            }else {
                this.votes.push(candidate);
                this.candidates.splice(index,1);
            }
        },
        removeVote: function(vote, index) {
            this.candidates.push(vote);
            this.votes.splice(index, 1);
        },
        submitVote: function() {
            axios.post('/submit-vote', {
                votes: this.votes
            }).then(response=>{
                if(response.status=201) {
                    this.voted = true;
                    this.getVotedCandidates();
                }
            })
        },
        checkHasVoted: function() {
            axios.get('/has-voted')
            .then(response=>{
                if(response.status==200) {
                    if(response.data) {
                        this.voted=true
                    }
                }
            })
        },
        getVotedCandidates: function() {
            axios.get('/votes')
            .then(response=>{
                if(response.status=200) {
                    this.votedCandidates = response.data;
                }
            })
        }
    },
    created() {
        this.checkHasVoted();
        if(!this.voted) {
            this.getMax();
            this.getCandidates();
            this.getVotedCandidates();
        }
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
