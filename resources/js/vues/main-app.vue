<template>
    <div>
        <search-form v-if="currentPhase('nomination')"></search-form>
        <selection v-if="currentPhase('selection')"></selection>
        <voting v-if="currentPhase('votation')" max=3></voting>
    </div>
</template>

<script>

import SearchForm from './nomination/search-form'
import Selection from './nomination/selection'
import Voting from './voting/voting'

export default({
    data:function(){
        return {
            phase: 'pending',
        }
    },
    components: {
        SearchForm,
        Voting,
        Selection
    },
    methods: {
        currentPhase(phaseName) {
            return this.phase==phaseName;
        },
        checkPhase: function() {
            axios.get('/check-phase')
            .then(response=>{
                this.phase = response.data;
            });
        }
    },
    created() {
        this.checkPhase();
    }
})

</script>
