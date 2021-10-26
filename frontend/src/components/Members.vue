<template>
  <div>
    <h1>{{ msg }}</h1>

    <MemberDialog 
      :dialogOpen="dialogOpen" 
      :dialogMode="dialogMode" 
      :selectedMember="selectedMember"
      :closeDialog="closeDialog" 
      :saveMember="saveMember"
      :deleteMember="deleteMember"
    />

    <div>
      <md-button class="md-raised md-primary" @click="createMemberDialog">
        <md-icon>add</md-icon> Create Member
      </md-button>
    </div>

    <md-table id="main_table">
      <md-table-row id="table_titles">
        <md-table-head >ID</md-table-head>
        <md-table-head>Name</md-table-head>
        <md-table-head>Email</md-table-head>
        <md-table-head>Gender</md-table-head>
        <md-table-head>Job Title</md-table-head>
        <md-table-head>Setting</md-table-head>
      </md-table-row>

      <md-table-row v-for="(member, index) in members" :key="member.id">
        <md-table-cell>{{ index + 1 }}</md-table-cell>
        <md-table-cell>{{ member.name }}</md-table-cell>
        <md-table-cell>{{ member.email }}</md-table-cell>
        <md-table-cell>{{ member.gender }}</md-table-cell>
        <md-table-cell>{{ member.job_title }}</md-table-cell>
        <md-table-cell>
          <md-button class="md-raised md-primary" @click="editMemberDialog(member)"><md-icon>edit</md-icon> Edit</md-button>
          <md-button class="md-raised md-accent" @click="deleteMemberDialog(member)"><md-icon>delete</md-icon> Delete</md-button>
        </md-table-cell>
      </md-table-row>

    </md-table>
  </div>
</template>

<script>
import axios from 'axios'
import MemberDialog from './MemberDialog.vue'
import config from './../constants/config'

export default {
  name: 'Members',
  components: {
    MemberDialog
  },
  props: {
    msg: String
  },
  data: () => ({
    dialogOpen: false,
    dialogMode: 1,
    selectedMember: {
      id: 0,
      name: '',
      email: '',
      gender: 'male',
      job_title: ''
    },
    members: []
  }),
  mounted() {
    // Get Members
    this.getMembers();
  },
  methods: {
    showDialog(dialogMode) {
      this.dialogOpen = true
      this.dialogMode = dialogMode
    },
    createMemberDialog() {
      this.selectedMember = {
        id: 0,
        name: '',
        email: '',
        gender: 'male',
        job_title: ''
      }
      this.showDialog(1)
    },
    editMemberDialog(member) {
      this.selectedMember = member
      this.showDialog(2)
    },
    deleteMemberDialog(member) {
      this.selectedMember = member
      this.showDialog(0)
    },
    closeDialog() {
      this.dialogOpen = false
    },
    getMembers() {
      axios.get(config.API_URL + '/members')
        .then((res) => {
          this.members = res.data
        })
        .catch((err) => {
          console.log('err', err)
        })
    },
    validateForm(member) {
      if (member.name === '' || member.email === '' || member.job_title === '') {
        return false
      }
      return true
    },
    saveMember(selectedMember) {
      console.log('selectedMember', selectedMember)
      if (!this.validateForm(selectedMember)) {
        alert('Not valid')
        return;
      }
      if (selectedMember.id === 0) {
        // Create
        axios.post(config.API_URL + '/create_member', selectedMember)
          .then(() => {
            this.closeDialog()
            this.getMembers()
          })
          .catch((err) => {
            console.log('err', err)
          })
      }
      else {
        // Update
        axios.put(config.API_URL + '/edit_member/' + selectedMember.id, selectedMember)
          .then(() => {
            this.closeDialog()
          })
          .catch((err) => {
            console.log('err', err)
          })
      }
    },
    deleteMember(memberId) {
      console.log('memberId', memberId)
      // Delete
      axios.delete(config.API_URL + '/delete_member/' + memberId)
        .then(() => {
          this.closeDialog()
          this.getMembers()
        })
        .catch((err) => {
          console.log('err', err)
        })
    }
  }
}
</script>

<style scoped>
  #main_table {
    width: 80%;
    margin-left: 10%;
    margin-top: 3%;
    border: 1px solid;
  }
  .md-table-head {
    text-align: center !important;
    background-color: #bfbfbf;
  }
</style>