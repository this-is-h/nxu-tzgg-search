<script setup>

</script>

<template>
    <div id="docsearch"></div>
</template>

<style>
    #docsearch {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    @media screen and (min-width: 768px) {
        #docsearch > button {
            width: 500px;
            height: 50px;
            font-size: 1.5em;
            padding: 0 1em;
        }

        #docsearch .DocSearch-Button-Placeholder {
            margin-left: 0.5em;
        }
    }
</style>