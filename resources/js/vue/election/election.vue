<template>
    <div>
        <h3>Election Proper</h3>

        <div class="row" v-if="votedAt==''">
            <div class="col-md-5">
                <h4>List of Candidates</h4>

                <div v-for="(candidate, index) in candidates" v-bind:key="index"
                        class="card mb-2" style="cursor: pointer" @click="selectCandidate(index)">
                    <div class="card-body d-flex">
                        <img :src="candidate.imgUrl" alt="Profile Picture" style="width:60px; height: 60px">
                        <div style="margin-left: 20px; line-height: 120%">
                            <strong style="font-size: 1.2em">{{candidate.lname}}, {{candidate.fname}}</strong>
                            <br>{{candidate.designation}}, <br>
                            <i>{{candidate.school}}</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div col-md-6 offset-md-1">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>My Ballot</h4>
                    </div>
                    <div class="card-body">
                        <div v-for="(candidate, index) in selectedCandidates" v-bind:key="index"
                                class="card mb-2" style="cursor: pointer" @click="removeCandidate(index)">
                            <div class="card-body d-flex">
                                <img :src="candidate.imgUrl" alt="Profile Picture" style="width:60px; height: 60px">
                                <div style="margin-left: 20px; line-height: 120%">
                                    <strong style="font-size: 1.2em">{{candidate.lname}}, {{candidate.fname}}</strong>
                                    <br>{{candidate.designation}}, <br>
                                    <i>{{candidate.school}}</i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="button" @click="submitVotes()">
                                <i class="fa fa-check"></i> Submit Votes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="votedAt!=''">
            <div class="col-md-5">
                <div class="alert alert-success">
                    Thank you for your participation of our PSITE-7 Regional Election.
                </div>
                <h4>You've voted for the following candidates:</h4>

                <div v-for="(candidate, index) in votedCandidates" v-bind:key="index"
                        class="card mb-2" style="cursor: pointer" @click="selectCandidate(index)">
                    <div class="card-body d-flex">
                        <img :src="candidate.imgUrl" alt="Profile Picture" style="width:60px; height: 60px">
                        <div style="margin-left: 20px; line-height: 120%">
                            <strong style="font-size: 1.2em">{{candidate.lname}}, {{candidate.fname}}</strong>
                            <br>{{candidate.designation}}, <br>
                            <i>{{candidate.school}}</i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

export default {
    data: function() {
        return {
            candidates: [],
            selectedCandidates: [],
            nvotes: 0,
            votedAt: null,
            votedCandidates: []
        }
    },
    methods: {
        getCandidates: function() {
            axios.get('/election/candidates')
            .then(response=>{
                if(response.status==200) {
                    this.candidates = response.data.candidates;
                    this.nvotes = response.data.numberOfVotes;
                }
            })
        },
        selectCandidate: function(index) {
            if(this.selectedCandidates.length>=this.nvotes) {
                alert("You can only vote a maximum of " + this.nvotes + " candidates.");
                return;
            }

            var selected = this.candidates[index];
            this.selectedCandidates.push(selected);
            this.candidates.splice(index, 1);
        },
        removeCandidate: function(index) {
            var selected = this.selectedCandidates[index];
            this.candidates.push(selected);
            this.selectedCandidates.splice(index, 1);
        },
        submitVotes: function() {
            axios.post('/election/submit-vote',{
                votes: this.selectedCandidates
            }).then(response=>{
                if(response.status==200){
                    this.votedAt = response.data;
                    this.getVotedCandidates();
                }
            })
        },
        getVotedCandidates: function() {
            axios.get('/election/voted-candidates')
                .then(response=>{
                    if(response.status==200){
                        this.votedCandidates = response.data
                    }
                })
        },
        checkInit: function() {
            axios.get('/election/voted-at')
                .then(response=>{
                    if(response.status==200) {
                        this.votedAt = response.data;
                        console.log(this.votedAt);
                        if(this.votedAt=="") {
                            this.getCandidates();
                        }else {
                            this.getVotedCandidates();
                        }
                    }
                });
        }
    },
    created() {
        this.checkInit();
    }
}

</script>
