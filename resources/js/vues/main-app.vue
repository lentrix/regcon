<template>
    <div>
        <search-form v-if="currentPhase('nomination')"></search-form>
        <selection v-if="currentPhase('selection')"></selection>
    </div>
</template>

<script>

import SearchForm from './nomination/search-form'
import Selection from './nomination/selection'

export default({
    data:function(){
        return {
            phase: 'pending'
        }
    },
    components: {
        SearchForm,
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
