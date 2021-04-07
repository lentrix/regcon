<template>
    <div>
        <h3>Raffle Draw</h3>

        <div class="row">
            <div class="col-md-4">
                <h4>Drawable Items</h4>
                <label><input type="checkbox" :checked="exclusive" @click="getParticipants()"> Exclude Previous Winners</label>
                <ul class="list-group">
                    <li class="list-group-item d-flex" style="cursor:pointer; line-height:110%"
                            v-for="(item, index) in items" v-bind:key="index" @click="drawItem(index)">
                        <div class="flex-grow-1">{{item.itemName}}</div>
                        <div>
                            <span class="badge badge-success">
                                {{item.qty}}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-5" id="draw-container">
                <div class="card draw" v-if="cardContent!=null">
                    <div class="card-body text-center" v-bind:class="drawBG">
                        <h3 v-if="showControls">Congratulations!!!</h3>
                        <img :src="cardContent.imgUrl" alt="Profile Picture" class="profile-pic"> <br>
                        <strong class="participant-name">{{cardContent.lname}}, {{cardContent.fname}}</strong> <br>
                        <i>{{cardContent.school}}</i>
                        <div class="controls" v-if="showControls">
                            You won <br>
                            <strong>{{item.itemName}}</strong> <br>
                            courtesy of {{item.sponsor}}

                            <div class="row mt-2">
                                <div class="col-sm-6">
                                    <button class="btn btn-danger btn-block" @click="cancel()">
                                        <i class="fa fa-ban"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-success btn-block" @click="commit()">
                                        <i class="fa fa-check"></i> Commit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>List of Winners</h4>
                <ul class="list-group">
                    <li class="list-group-item" style="line-height: 110%"
                            v-for="(draw, index) in draws" v-bind:key="index">
                        <strong>{{draw.lname}}, {{draw.fname}}</strong> <br>
                        {{draw.itemName}}
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    data: function() {
        return {
            items: [],
            item: null,
            draws: [],
            participants: [],
            exclusive: true,
            cardContent: null,
            showControls: false,
            drawBG: "bg-danger"
        }
    },
    methods: {
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
        },
        getParticipants: function() {
            axios.get('/admin/raffles/participants/' + (this.exclusive ? "true" : "false"))
                    .then(response=>{
                        if(response.status == 200) {
                            this.participants = response.data
                        }
                    })
        },
        drawItem: function(item) {

            $('html, body').animate({
                scrollTop: ($('#draw-container').offset().top)
            },500);

            this.item = this.items[item];
            this.showControls = false;
            this.drawBG = "bg-danger";

            for(var i=0; i<20; i++) {
                setTimeout(()=>this.cardContent = this.participants[Math.floor(Math.random() * this.participants.length)], 150*i)
            }

            setTimeout(()=>{
                this.showControls = true;
                this.drawBG = "bg-confetti";
            }, 150*21);
        },
        reset: function() {
            this.showControls = false;
            this.drawBG = "bg-danger";
            this.cardContent = null;
        },
        cancel: function() {
            this.reset();
        },
        commit: function() {
            axios.post('/admin/raffles/commit', {
                'raffle_item_id': this.item.id,
                'participant_id': this.cardContent.participant_id
            }).then(response=>{
                if(response.status==200){
                    this.reset();
                    this.getDraws();
                    this.getItems();
                }
            })
        }
    },
    created() {
        this.getItems();
        this.getDraws();
        this.getParticipants();
    }
}
</script>

<style scoped>
.profile-pic {
    width: 180px;
    height: 180px;
}

.participant-name {
    font-size: 1.5em;
}

.draw {
    font-size: 1.2em;
}

.bg-confetti {
    background-image: url('https://i.pinimg.com/originals/12/4d/e3/124de3d1b5e12f1d8fcec1685e634361.gif');
    background-size: cover;
}
</style>
