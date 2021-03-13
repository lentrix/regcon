<template>

<div class="modal fade" id="nominateModal" tabindex="-1" aria-labelledby="nominateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="nominateModalLabel">Nomination</h3>
        <button type="button" class="btn btn-sm btn-warning" @click="close()" data-dismiss="modal" aria-label="Close">
            <div class="fa fa-close"></div>
        </button>
      </div>
      <div class="modal-body">
        <div v-if="nominee">
            <div class="alert alert-success">You are about to nominate...</div>
            <div class="nominee-block">
                <img :src="nominee.imgUrl" alt="Nominee Picture" class="nominee-pic">
                <div class="nominee-info">
                    <strong style="font-size: 1.2em">{{nominee.lname}}, {{nominee.fname}}</strong> <br>
                    <i>{{nominee.designation}}</i><br>
                    {{nominee.school}}
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="close()">Cancel</button>
        <button type="button" class="btn btn-primary" @click="nominate()">
            <i class="fa fa-check"></i>
            Nominate
        </button>
      </div>
    </div>
  </div>
</div>

</template>

<script>

export default({
    props: {
        nominee: null
    },
    methods: {
        close: function() {
            $("#nominateModal").modal('hide');
        },
        nominate: function() {
            axios.post('/nominate', {
                participant: this.nominee.id
            })
            .then( response => {
                if(response.status == 201) {
                    this.close();
                    this.$emit('nominated', this.nominee);
                }else if(response.status == 500) {
                    console.log(response.message);
                }
            }).catch(error=>{
                console.log(error);
            });
        }
    }
})
</script>

<style scoped>
.nominee-block {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.nominee-pic {
    width: 200px;
    border-radius: 100px;
    margin-right: 20px;
}
.nominee-info {
    font-size: 1.4em;
    line-height: 95%;
}
</style>
