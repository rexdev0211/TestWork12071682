<template>
  <md-dialog :md-active.sync="dialogOpen">
    <md-dialog-title v-if="dialogMode === 1">Create Member</md-dialog-title>
    <md-dialog-title v-else-if="dialogMode === 2">Edit Member</md-dialog-title>
    <md-dialog-title v-else>Delete Member</md-dialog-title>
    <div v-if="dialogMode > 0" class="member-dialog">
      <form>
        <md-field>
          <label>Name</label>
          <md-input v-model="selectedMember.name" md-counter="30"></md-input>
        </md-field>

        <md-field>
          <label>Email</label>
          <md-input v-model="selectedMember.email" md-counter="30"></md-input>
        </md-field>

        <div>
          <md-radio v-model="selectedMember.gender" value="male">Male</md-radio>
          <md-radio v-model="selectedMember.gender" value="female" class="md-primary">Female</md-radio>
        </div>

        <md-field>
          <label>Job Title</label>
          <md-input v-model="selectedMember.job_title" md-counter="30"></md-input>
        </md-field>

        <md-button class="md-raised" type="reset">RESET</md-button>
      </form>
    </div>
    <div v-else class="member-dialog">
      <h1>Do you really want to delete member?</h1>
    </div> 
    <md-dialog-actions>
      <md-button class="md-primary" @click="closeDialog">Close</md-button>
      <md-button v-if="dialogMode !== 0" class="md-primary" @click="saveMember(selectedMember)">Save</md-button>
      <md-button v-else class="md-primary" @click="deleteMember(selectedMember.id)">Delete</md-button>
    </md-dialog-actions>
  </md-dialog>
</template>

<script>
  export default {
    name: 'MemberDialog',
    props: {
      dialogOpen: Boolean,
      dialogMode: Number,
      selectedMember: Object,
      closeDialog: Function,
      saveMember: Function,
      deleteMember: Function
    },
  }
</script>

<style scoped>
  .member-dialog {
    width: 100%;
    padding: 20px;
  }
</style>