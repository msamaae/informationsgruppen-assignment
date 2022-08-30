<template>
    <div class="auth-layout">
        <!-- Auth Layout -->
        <router-view></router-view>
    </div>
</template>

<style lang="scss">
.auth-layout {
    display: flex;
    max-width: 500px;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    height: 100%;
    padding-bottom: 160px;
}

.form-text  {
    font-weight: bold;
    
    &.error {
        color: #ef233c;
    }
    
    &.success {
        color: #60d394;
    }
}

.form-container {
    width: 300px;
    padding: 2rem;
    font-size: 1rem;
    background: #fff;
    border: 1px solid dimgray;
    border-radius: 6px;
}

.form-control {
    margin-bottom: .8rem;
}

.form-input {
    width: 100%;
    padding: 12px 8px;
}

.form-btn {
    padding: 8px 16px;
    text-transform: uppercase;
    font-weight: 600;
    background: #60d394;
    color: #0D2818;
    border: none;
    border-radius: 2px;
    margin-top: 6px;
    width: 100%;
}
</style>

